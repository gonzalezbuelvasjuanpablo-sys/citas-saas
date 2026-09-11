<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Paso 1: Página principal del negocio
    public function show(string $slug)
    {
        $business = Business::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $services = Service::where('business_id', $business->id)
            ->where('is_active', true)
            ->get();

        $employees = Employee::where('business_id', $business->id)
            ->where('is_active', true)
            ->with('user')
            ->get();

        return view('booking.show', compact('business', 'services', 'employees'));
    }

    // Paso 2: Obtener slots disponibles
    public function slots(Request $request, string $slug)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'service_id'  => 'required|exists:services,id',
            'date'        => 'required|date|after_or_equal:today',
        ]);

        $business = Business::where('slug', $slug)->firstOrFail();
        $service  = Service::find($request->service_id);
        $employee = Employee::find($request->employee_id);
        $date     = Carbon::parse($request->date);

        // Obtener horario del empleado para ese día
        $schedule = $employee->schedules()
            ->where('day_of_week', $date->dayOfWeek)
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return response()->json(['slots' => []]);
        }

        // Generar slots cada 30 minutos
        $slots      = [];
        $duration   = $service->duration_minutes;
        $current    = Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->start_time);
        $end        = Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->end_time);

        // Citas existentes del empleado ese día
        $existing = Appointment::where('employee_id', $employee->id)
            ->whereDate('starts_at', $date)
            ->where('status', '!=', 'cancelled')
            ->get();

        while ($current->copy()->addMinutes($duration)->lte($end)) {
            $slotEnd = $current->copy()->addMinutes($duration);

            // Verificar que no choca con cita existente
            $available = true;
            foreach ($existing as $apt) {
                if ($current->lt($apt->ends_at) && $slotEnd->gt($apt->starts_at)) {
                    $available = false;
                    break;
                }
            }

            // No mostrar slots pasados
            if ($current->isPast()) {
                $available = false;
            }

            if ($available) {
                $slots[] = $current->format('H:i');
            }

            $current->addMinutes(30);
        }

        return response()->json(['slots' => $slots]);
    }

    // Paso 3: Confirmar reserva
    public function store(Request $request, string $slug)
    {
        $request->validate([
            'service_id'  => 'required|exists:services,id',
            'employee_id' => 'required|exists:employees,id',
            'date'        => 'required|date|after_or_equal:today',
            'time'        => 'required',
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'email'       => 'nullable|email',
        ]);

        $business = Business::where('slug', $slug)->firstOrFail();
        $service  = Service::find($request->service_id);

        $starts_at = Carbon::parse($request->date . ' ' . $request->time);
        $ends_at   = $starts_at->copy()->addMinutes($service->duration_minutes);

        // Crear o encontrar cliente
        $client = Client::firstOrCreate(
            [
                'business_id' => $business->id,
                'phone'       => $request->phone,
            ],
            [
                'name'  => $request->name,
                'email' => $request->email,
            ]
        );

        // Crear cita
        $appointment = Appointment::create([
            'business_id' => $business->id,
            'client_id'   => $client->id,
            'employee_id' => $request->employee_id,
            'service_id'  => $request->service_id,
            'starts_at'   => $starts_at,
            'ends_at'     => $ends_at,
            'status'      => 'confirmed',
            'notes'       => $request->notes,
        ]);

        return view('booking.confirmed', compact('appointment', 'business'));
    }
}
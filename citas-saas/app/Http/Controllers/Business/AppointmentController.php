<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $business = auth()->user()->business;

        $appointments = Appointment::where('business_id', $business->id)
            ->with(['client', 'employee.user', 'service'])
            ->orderBy('starts_at', 'desc')
            ->paginate(15);

        return view('business.appointments.index', compact('appointments', 'business'));
    }

    public function create()
    {
        $business = auth()->user()->business;

        $clients   = Client::where('business_id', $business->id)->get();
        $employees = Employee::where('business_id', $business->id)->where('is_active', true)->with('user')->get();
        $services  = Service::where('business_id', $business->id)->where('is_active', true)->get();

        return view('business.appointments.create', compact('clients', 'employees', 'services', 'business'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'employee_id' => 'required|exists:employees,id',
            'service_id'  => 'required|exists:services,id',
            'starts_at'   => 'required|date|after:now',
        ]);

        $business = auth()->user()->business;
        $service  = Service::find($request->service_id);

        $starts_at = \Carbon\Carbon::parse($request->starts_at);
        $ends_at   = $starts_at->copy()->addMinutes($service->duration_minutes);

        Appointment::create([
            'business_id' => $business->id,
            'client_id'   => $request->client_id,
            'employee_id' => $request->employee_id,
            'service_id'  => $request->service_id,
            'starts_at'   => $starts_at,
            'ends_at'     => $ends_at,
            'status'      => 'confirmed',
            'notes'       => $request->notes,
        ]);

        return redirect()->route('business.appointments.index')
            ->with('success', 'Cita creada exitosamente.');
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        return view('business.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed,no_show',
        ]);

        $appointment->update(['status' => $request->status]);

        return redirect()->route('business.appointments.index')
            ->with('success', 'Cita actualizada.');
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);
        $appointment->update(['status' => 'cancelled']);

        return redirect()->route('business.appointments.index')
            ->with('success', 'Cita cancelada.');
    }
}
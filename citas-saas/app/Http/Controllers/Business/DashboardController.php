<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $business = auth()->user()->business;

        $stats = [
            'total_appointments_today' => Appointment::where('business_id', $business->id)
                ->whereDate('starts_at', today())
                ->count(),

            'total_appointments_month' => Appointment::where('business_id', $business->id)
                ->whereMonth('starts_at', now()->month)
                ->count(),

            'total_clients' => Client::where('business_id', $business->id)
                ->count(),

            'total_services' => Service::where('business_id', $business->id)
                ->count(),
        ];

        $upcoming_appointments = Appointment::where('business_id', $business->id)
            ->where('starts_at', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->with(['client', 'employee', 'service'])
            ->orderBy('starts_at')
            ->limit(5)
            ->get();

        return view('business.dashboard', compact('stats', 'upcoming_appointments', 'business'));
    }
}
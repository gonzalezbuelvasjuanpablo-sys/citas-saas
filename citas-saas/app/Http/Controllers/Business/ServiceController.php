<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $business = auth()->user()->business;

        $services = Service::where('business_id', $business->id)
            ->orderBy('name')
            ->get();

        return view('business.services.index', compact('services', 'business'));
    }

    public function create()
    {
        $business = auth()->user()->business;
        return view('business.services.create', compact('business'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:5|max:480',
            'price'            => 'required|numeric|min:0',
        ]);

        $business = auth()->user()->business;

        Service::create([
            'business_id'      => $business->id,
            'name'             => $request->name,
            'description'      => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'price'            => $request->price,
            'is_active'        => true,
        ]);

        return redirect()->route('business.services.index')
            ->with('success', 'Servicio creado exitosamente.');
    }

    public function edit(Service $service)
    {
        $business = auth()->user()->business;
        $this->authorize('update', $service);
        return view('business.services.edit', compact('service', 'business'));
    }

    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);

        $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:5|max:480',
            'price'            => 'required|numeric|min:0',
        ]);

        $service->update([
            'name'             => $request->name,
            'description'      => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'price'            => $request->price,
            'is_active'        => $request->boolean('is_active'),
        ]);

        return redirect()->route('business.services.index')
            ->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);
        $service->delete();

        return redirect()->route('business.services.index')
            ->with('success', 'Servicio eliminado.');
    }
}
@extends('layouts.business')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detalle de cita</h2>
        <p class="text-gray-500">Información completa de la cita</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Info de la cita -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Información</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Cliente</span>
                    <span class="font-medium">{{ $appointment->client->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Servicio</span>
                    <span class="font-medium">{{ $appointment->service->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Empleado</span>
                    <span class="font-medium">{{ $appointment->employee->user->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Fecha</span>
                    <span class="font-medium">{{ $appointment->starts_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Hora inicio</span>
                    <span class="font-medium">{{ $appointment->starts_at->format('H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Hora fin</span>
                    <span class="font-medium">{{ $appointment->ends_at->format('H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Duración</span>
                    <span class="font-medium">{{ $appointment->service->duration_minutes }} min</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Precio</span>
                    <span class="font-medium">${{ number_format($appointment->service->price, 0, ',', '.') }}</span>
                </div>
                @if($appointment->notes)
                <div class="flex justify-between">
                    <span class="text-gray-500">Notas</span>
                    <span class="font-medium">{{ $appointment->notes }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Cambiar estado -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Estado actual</h3>
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $appointment->status === 'no_show' ? 'bg-gray-100 text-gray-700' : '' }}">
                {{ ucfirst($appointment->status) }}
            </span>

            <form method="POST" action="{{ route('business.appointments.update', $appointment) }}" class="mt-6">
                @csrf
                @method('PUT')
                <label class="block text-sm font-medium text-gray-700 mb-2">Cambiar estado</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4">
                    <option value="pending"   {{ $appointment->status === 'pending'   ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                    <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completada</option>
                    <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                    <option value="no_show"   {{ $appointment->status === 'no_show'   ? 'selected' : '' }}>No asistió</option>
                </select>
                <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-medium">
                    Guardar cambio
                </button>
            </form>

            <div class="mt-4">
                <a href="{{ route('business.appointments.index') }}" class="block text-center bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 font-medium">
                    Volver a citas
                </a>
            </div>
        </div>
    </div>
@endsection
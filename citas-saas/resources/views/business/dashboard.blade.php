@extends('layouts.business')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
        <p class="text-gray-500">Bienvenido, {{ auth()->user()->name }}</p>
    </div>

        <!-- Link de reservas -->
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl px-6 py-4 mb-6 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-indigo-700">Tu link de reservas</p>
            <p class="text-indigo-600 font-mono text-sm mt-1">
                {{ url('/book/' . $business->slug) }}
            </p>
        </div>
        <a href="{{ url('/book/' . $business->slug) }}" target="_blank"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
            Ver página
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Citas hoy</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_appointments_today'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Citas este mes</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_appointments_month'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Clientes</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_clients'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Servicios</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['total_services'] }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Próximas citas</h3>
        @if($upcoming_appointments->isEmpty())
            <p class="text-gray-400">No hay citas próximas.</p>
        @else
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b">
                        <th class="pb-3">Cliente</th>
                        <th class="pb-3">Servicio</th>
                        <th class="pb-3">Empleado</th>
                        <th class="pb-3">Fecha y hora</th>
                        <th class="pb-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($upcoming_appointments as $appointment)
                        <tr>
                            <td class="py-3">{{ $appointment->client->name }}</td>
                            <td class="py-3">{{ $appointment->service->name }}</td>
                            <td class="py-3">{{ $appointment->employee->user->name }}</td>
                            <td class="py-3">{{ $appointment->starts_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ['pending' => 'Pendiente', 'confirmed' => 'Confirmada', 'completed' => 'Completada', 'cancelled' => 'Cancelada', 'no_show' => 'No asistió'][$appointment->status] ?? $appointment->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
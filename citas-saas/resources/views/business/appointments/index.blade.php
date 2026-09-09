@extends('layouts.business')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Citas</h2>
            <p class="text-gray-500">Gestiona todas las citas de tu negocio</p>
        </div>
        <a href="{{ route('business.appointments.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-medium">+ Nueva cita</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-500 border-b">
                    <th class="px-6 py-4">Cliente</th>
                    <th class="px-6 py-4">Servicio</th>
                    <th class="px-6 py-4">Empleado</th>
                    <th class="px-6 py-4">Fecha y hora</th>
                    <th class="px-6 py-4">Estado</th>
                    <th class="px-6 py-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($appointments as $appointment)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $appointment->client->name }}</td>
                        <td class="px-6 py-4">{{ $appointment->service->name }}</td>
                        <td class="px-6 py-4">{{ $appointment->employee->user->name }}</td>
                        <td class="px-6 py-4">{{ $appointment->starts_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $appointment->status === 'no_show' ? 'bg-gray-100 text-gray-700' : '' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <a href="{{ route('business.appointments.show', $appointment) }}" class="text-indigo-600 hover:underline">Ver</a>
                            <form method="POST" action="{{ route('business.appointments.destroy', $appointment) }}" onsubmit="return confirm('¿Cancelar esta cita?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Cancelar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">No hay citas registradas aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $appointments->links() }}</div>
    </div>
@endsection
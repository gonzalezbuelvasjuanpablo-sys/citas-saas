@extends('layouts.business')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Empleados</h2>
            <p class="text-gray-500">Gestiona tu equipo de trabajo</p>
        </div>
        <a href="{{ route('business.employees.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-medium">+ Nuevo empleado</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-500 border-b">
                    <th class="px-6 py-4">Nombre</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Cargo</th>
                    <th class="px-6 py-4">Estado</th>
                    <th class="px-6 py-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($employees as $employee)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $employee->user->name }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $employee->user->email }}</td>
                        <td class="px-6 py-4">{{ $employee->title ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if($employee->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Activo</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <a href="{{ route('business.employees.edit', $employee) }}" class="text-indigo-600 hover:underline">Editar</a>
                            <form method="POST" action="{{ route('business.employees.destroy', $employee) }}" onsubmit="return confirm('¿Eliminar este empleado?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">No hay empleados registrados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
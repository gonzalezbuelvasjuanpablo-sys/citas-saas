@extends('layouts.business')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Editar empleado</h2>
        <p class="text-gray-500">Modifica los datos del empleado</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('business.employees.update', $employee) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                <input type="text" name="name" value="{{ old('name', $employee->user->name) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" value="{{ $employee->user->email }}" disabled
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 bg-gray-50 text-gray-400">
                <p class="text-xs text-gray-400 mt-1">El email no se puede cambiar.</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cargo o título</label>
                <input type="text" name="title" value="{{ old('title', $employee->title) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $employee->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-indigo-600">
                    <span class="text-sm font-medium text-gray-700">Empleado activo</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-medium">Guardar cambios</button>
                <a href="{{ route('business.employees.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 font-medium">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
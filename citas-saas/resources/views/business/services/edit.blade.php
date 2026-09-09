@extends('layouts.business')

@section('content')

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Editar servicio</h2>
        <p class="text-gray-500">Modifica los datos del servicio</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('business.services.update', $service) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del servicio</label>
                <input type="text" name="name" value="{{ old('name', $service->name) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea name="description" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Duración (minutos)</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           min="5" max="480">
                    @error('duration_minutes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                    <input type="number" name="price" value="{{ old('price', $service->price) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           min="0" step="100">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-indigo-600">
                    <span class="text-sm font-medium text-gray-700">Servicio activo</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-medium">
                    Guardar cambios
                </button>
                <a href="{{ route('business.services.index') }}"
                   class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 font-medium">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

@endsection
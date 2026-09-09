@extends('layouts.business')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Nueva cita</h2>
        <p class="text-gray-500">Agenda una cita manualmente</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('business.appointments.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                <select name="client_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Selecciona un cliente</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }} — {{ $client->phone }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                <select name="service_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Selecciona un servicio</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} — {{ $service->duration_minutes }}min — ${{ number_format($service->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Empleado</label>
                <select name="employee_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Selecciona un empleado</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->user->name }} — {{ $employee->title }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha y hora</label>
                <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('starts_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Notas (opcional)</label>
                <textarea name="notes" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                          placeholder="Alguna indicación especial...">{{ old('notes') }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-medium">Crear cita</button>
                <a href="{{ route('business.appointments.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 font-medium">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
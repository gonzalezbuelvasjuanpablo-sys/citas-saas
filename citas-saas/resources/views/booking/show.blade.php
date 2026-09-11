<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar cita — {{ $business->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

    <!-- Header -->
    <div class="bg-white shadow-sm py-6 px-4 text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">{{ $business->name }}</h1>
        <p class="text-gray-500 mt-1">{{ $business->address }}</p>
    </div>

    <div class="max-w-2xl mx-auto px-4 pb-12">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Reserva tu cita</h2>

        <form method="POST" action="{{ route('booking.store', $business->slug) }}" id="booking-form">
            @csrf

            <!-- Paso 1: Servicio -->
            <div class="bg-white rounded-xl shadow p-6 mb-4">
                <h3 class="font-bold text-gray-700 mb-4">1. Elige un servicio</h3>
                <div class="grid grid-cols-1 gap-3">
                    @foreach($services as $service)
                        <label class="flex items-center justify-between border rounded-lg p-4 cursor-pointer hover:border-indigo-500 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="service_id" value="{{ $service->id }}" class="text-indigo-600">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $service->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $service->duration_minutes }} minutos</p>
                                </div>
                            </div>
                            <span class="font-bold text-indigo-600">${{ number_format($service->price, 0, ',', '.') }}</span>
                        </label>
                    @endforeach
                </div>
                @error('service_id')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            <!-- Paso 2: Empleado -->
            <div class="bg-white rounded-xl shadow p-6 mb-4">
                <h3 class="font-bold text-gray-700 mb-4">2. Elige un profesional</h3>
                <div class="grid grid-cols-1 gap-3">
                    @foreach($employees as $employee)
                        <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer hover:border-indigo-500 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="employee_id" value="{{ $employee->id }}" class="text-indigo-600">
                            <div>
                                <p class="font-medium text-gray-800">{{ $employee->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $employee->title }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('employee_id')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            <!-- Paso 3: Fecha -->
            <div class="bg-white rounded-xl shadow p-6 mb-4">
                <h3 class="font-bold text-gray-700 mb-4">3. Elige una fecha</h3>
                <input type="date" name="date" id="date-picker"
                       min="{{ now()->format('Y-m-d') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('date')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            <!-- Paso 4: Hora -->
            <div class="bg-white rounded-xl shadow p-6 mb-4" id="slots-container" style="display:none">
                <h3 class="font-bold text-gray-700 mb-4">4. Elige una hora</h3>
                <div id="slots-grid" class="grid grid-cols-4 gap-2"></div>
                <input type="hidden" name="time" id="selected-time">
                @error('time')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            <!-- Paso 5: Datos del cliente -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="font-bold text-gray-700 mb-4">5. Tus datos</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email (opcional)</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notas (opcional)</label>
                    <textarea name="notes" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold text-lg hover:bg-indigo-700">
                Confirmar reserva
            </button>
        </form>
    </div>

    <script>
        const datePicker = document.getElementById('date-picker');
        const slotsContainer = document.getElementById('slots-container');
        const slotsGrid = document.getElementById('slots-grid');
        const selectedTime = document.getElementById('selected-time');

        function loadSlots() {
            const employeeId = document.querySelector('input[name="employee_id"]:checked')?.value;
            const serviceId = document.querySelector('input[name="service_id"]:checked')?.value;
            const date = datePicker.value;

            if (!employeeId || !serviceId || !date) return;

            fetch(`/book/{{ $business->slug }}/slots?employee_id=${employeeId}&service_id=${serviceId}&date=${date}`)
                .then(r => r.json())
                .then(data => {
                    slotsGrid.innerHTML = '';
                    if (data.slots.length === 0) {
                        slotsGrid.innerHTML = '<p class="text-gray-400 col-span-4">No hay horarios disponibles para este día.</p>';
                    } else {
                        data.slots.forEach(slot => {
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.textContent = slot;
                            btn.className = 'border rounded-lg py-2 text-sm font-medium hover:bg-indigo-50 hover:border-indigo-500 focus:bg-indigo-600 focus:text-white';
                            btn.onclick = () => {
                                document.querySelectorAll('#slots-grid button').forEach(b => b.classList.remove('bg-indigo-600', 'text-white'));
                                btn.classList.add('bg-indigo-600', 'text-white');
                                selectedTime.value = slot;
                            };
                            slotsGrid.appendChild(btn);
                        });
                    }
                    slotsContainer.style.display = 'block';
                });
        }

        datePicker.addEventListener('change', loadSlots);
        document.querySelectorAll('input[name="employee_id"]').forEach(r => r.addEventListener('change', loadSlots));
        document.querySelectorAll('input[name="service_id"]').forEach(r => r.addEventListener('change', loadSlots));
    </script>

</body>
</html>
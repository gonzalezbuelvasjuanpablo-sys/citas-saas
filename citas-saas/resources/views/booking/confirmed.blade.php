<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita confirmada — {{ $business->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

            <!-- Icono de éxito -->
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-2">¡Cita confirmada!</h1>
            <p class="text-gray-500 mb-6">Tu cita ha sido reservada exitosamente.</p>

            <!-- Detalles -->
            <div class="bg-gray-50 rounded-xl p-4 text-left space-y-3 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Negocio</span>
                    <span class="font-medium">{{ $business->name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Servicio</span>
                    <span class="font-medium">{{ $appointment->service->name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Profesional</span>
                    <span class="font-medium">{{ $appointment->employee->user->name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Fecha</span>
                    <span class="font-medium">{{ $appointment->starts_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Hora</span>
                    <span class="font-medium">{{ $appointment->starts_at->format('H:i') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Duración</span>
                    <span class="font-medium">{{ $appointment->service->duration_minutes }} minutos</span>
                </div>
            </div>

            <a href="{{ route('booking.show', $business->slug) }}"
               class="block w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700">
                Reservar otra cita
            </a>
        </div>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Citas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">
            {{ auth()->user()->business->name ?? 'Mi Negocio' }}
        </h1>
        <div class="flex items-center gap-4">
            <span class="text-gray-600 text-sm">{{ auth()->user()->name }}</span>
            <form method="POST" action="/logout">
                @csrf
                <button class="text-sm text-red-500 hover:underline">Cerrar sesión</button>
            </form>
        </div>
    </nav>
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-sm p-6 space-y-2">
            <a href="{{ route('business.dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Dashboard</a>
            <a href="{{ route('business.appointments.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Citas</a>
            <a href="{{ route('business.services.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Servicios</a>
            <a href="{{ route('business.employees.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium">Empleados</a>
        </aside>
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CitasSaaS — Gestiona tu negocio de citas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-4 shadow-sm">
        <h1 class="text-2xl font-bold text-indigo-600">CitasSaaS</h1>
        <div class="flex gap-4">
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 font-medium">Iniciar sesión</a>
            <a href="{{ route('business.register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-medium">Registra tu negocio</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="text-center py-20 px-4 bg-gradient-to-b from-indigo-50 to-white">
        <h2 class="text-5xl font-bold text-gray-800 mb-4">Gestiona tus citas<br>de forma inteligente</h2>
        <p class="text-xl text-gray-500 mb-8 max-w-2xl mx-auto">La plataforma para barberías, salones, odontólogos y más. Tus clientes reservan en línea, tú te enfocas en tu trabajo.</p>
        <div class="flex gap-4 justify-center">
            <a href="{{ route('business.register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold text-lg hover:bg-indigo-700">
                Empieza gratis
            </a>
            <a href="/book/barberia-el-tigre" class="bg-white text-indigo-600 border-2 border-indigo-600 px-8 py-3 rounded-xl font-bold text-lg hover:bg-indigo-50">
                Ver demo
            </a>
        </div>
    </section>

    <!-- Características -->
    <section class="py-20 px-8 max-w-6xl mx-auto">
        <h3 class="text-3xl font-bold text-center text-gray-800 mb-12">Todo lo que necesitas</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="text-center p-6">
                <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Reservas en línea</h4>
                <p class="text-gray-500">Tus clientes reservan 24/7 desde cualquier dispositivo sin llamadas ni mensajes.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Gestión de empleados</h4>
                <p class="text-gray-500">Administra tu equipo, asigna horarios y lleva el control de cada profesional.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Dashboard en tiempo real</h4>
                <p class="text-gray-500">Ve tus citas del día, clientes y estadísticas desde un panel intuitivo.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Horarios flexibles</h4>
                <p class="text-gray-500">Configura los horarios de cada empleado y el sistema calcula los slots disponibles.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Notificaciones</h4>
                <p class="text-gray-500">Tus clientes reciben confirmación automática por email al reservar su cita.</p>
            </div>

            <div class="text-center p-6">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">100% responsive</h4>
                <p class="text-gray-500">Funciona perfecto en
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registra tu negocio — CitasSaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center py-12">

    <div class="max-w-2xl w-full mx-4">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Registra tu negocio</h1>
            <p class="text-gray-500 mt-2">Empieza a recibir citas en minutos</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST" action="{{ route('business.register.store') }}">
                @csrf

                <!-- Datos del negocio -->
                <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">Datos del negocio</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del negocio</label>
                    <input type="text" name="business_name" value="{{ old('business_name') }}"
                           placeholder="Ej: Barbería El Tigre"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('business_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de negocio</label>
                    <select name="business_type" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Selecciona un tipo</option>
                        <option value="barbershop"      {{ old('business_type') === 'barbershop' ? 'selected' : '' }}>Barbería</option>
                        <option value="salon"           {{ old('business_type') === 'salon' ? 'selected' : '' }}>Salón de belleza</option>
                        <option value="dentist"         {{ old('business_type') === 'dentist' ? 'selected' : '' }}>Odontología</option>
                        <option value="psychologist"    {{ old('business_type') === 'psychologist' ? 'selected' : '' }}>Psicología</option>
                        <option value="personal_trainer"{{ old('business_type') === 'personal_trainer' ? 'selected' : '' }}>Entrenador personal</option>
                        <option value="other"           {{ old('business_type') === 'other' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('business_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               placeholder="+57 300 123 4567"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                               placeholder="Calle 72 #45-23"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Datos del dueño -->
                <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b mt-6">Datos del administrador</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tu nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Carlos Martínez"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="carlos@minegocio.com"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                        <input type="password" name="password"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold text-lg hover:bg-indigo-700">
                    Crear mi negocio
                </button>

                <p class="text-center text-sm text-gray-500 mt-4">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Inicia sesión</a>
                </p>

            </form>
        </div>
    </div>

</body>
</html>
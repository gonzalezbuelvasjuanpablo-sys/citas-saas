<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Business\DashboardController;
use App\Http\Controllers\Business\ServiceController;
use App\Http\Controllers\Business\EmployeeController;
use App\Http\Controllers\Business\AppointmentController;

// Ruta pública de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación (las genera Breeze)
require __DIR__.'/auth.php';

// Panel del negocio — solo business_owner y employee
Route::middleware(['auth', 'role:business_owner|employee'])
    ->prefix('business')
    ->name('business.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Servicios
        Route::resource('services', ServiceController::class);

        // Empleados
        Route::resource('employees', EmployeeController::class);

        // Citas
        Route::resource('appointments', AppointmentController::class);
    });

    // Redirect dashboard a panel del negocio
Route::get('/dashboard', function () {
    return redirect()->route('business.dashboard');
})->middleware(['auth'])->name('dashboard');

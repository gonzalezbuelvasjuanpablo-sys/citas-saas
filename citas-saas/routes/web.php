<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Business\DashboardController;
use App\Http\Controllers\Business\ServiceController;
use App\Http\Controllers\Business\EmployeeController;
use App\Http\Controllers\Business\AppointmentController;
use App\Http\Controllers\Booking\BookingController;

// Ruta pública de inicio
Route::get('/', function () {
    return view('welcome');
});


Route::prefix('book')->name('booking.')->group(function () {
    Route::get('/{slug}', [BookingController::class, 'show'])->name('show');
    Route::get('/{slug}/slots', [BookingController::class, 'slots'])->name('slots');
    Route::post('/{slug}', [BookingController::class, 'store'])->name('store');
});

// Rutas de autenticación (las genera Breeze)
require __DIR__.'/auth.php';

// Redirect dashboard a panel del negocio
Route::get('/dashboard', function () {
    return redirect()->route('business.dashboard');
})->middleware(['auth'])->name('dashboard');

// Panel del negocio — solo business_owner y employee
Route::middleware(['auth', 'role:business_owner|employee'])
    ->prefix('business')
    ->name('business.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('services', ServiceController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('appointments', AppointmentController::class);
    });
<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Ruta para la página de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Ruta para el dashboard, protegida por middleware de autenticación y verificación
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('routines', 'routines')
    ->middleware(['auth', 'verified'])
    ->name('routines');

Route::middleware(['auth'])->group(function () {
    // Ruta de redirección para 'settings' a 'settings/profile'
    Route::redirect('settings', 'settings/profile');

    // Rutas de configuración usando Livewire Volt
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';

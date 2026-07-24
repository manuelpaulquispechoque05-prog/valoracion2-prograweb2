<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;

// Rutas de autenticación (solo para invitados)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.store');
});

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
    Route::get('/servicios/crear', [ServicioController::class, 'create'])->name('servicios.create');
    Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
    Route::get('/servicios/{servicio}/editar', [ServicioController::class, 'edit'])->name('servicios.edit');
    Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
    Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

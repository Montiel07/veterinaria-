<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/logear', [AuthController::class, 'logear'])->name('logear');
});

Route::middleware("auth")->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/home-admin', [AuthController::class, 'homeAdmin'])->name('home_admin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Módulo Direcciones
    Route::resource('direcciones', DireccionController::class);

    // Módulo Pacientes
    Route::resource('pacientes', PacienteController::class);

    // Módulo Usuarios
    Route::resource('usuarios', UsuarioController::class);
});

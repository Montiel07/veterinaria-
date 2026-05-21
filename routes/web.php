<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\ConsultaController;
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

    // Módulo Expedientes
    Route::get('/expedientes', [ExpedienteController::class, 'index'])->name('expedientes.index');
    Route::get('/expedientes/buscar-ajax', [ExpedienteController::class, 'buscarAjax'])->name('expedientes.buscar_ajax');
    Route::get('/expedientes/{id}', [ExpedienteController::class, 'show'])->name('expedientes.show');
    Route::get('/expedientes/{id}/consultas', [ConsultaController::class, 'show'])->name('expedientes.consultas');
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}', [ConsultaController::class, 'detalle'])->name('expedientes.consultas.detalle');
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}/diagnostico', [ConsultaController::class, 'diagnostico'])->name('expedientes.consultas.diagnostico');
    Route::post('/expedientes/{mascota_id}/consultas/{consulta_id}/diagnostico', [ConsultaController::class, 'guardarDiagnostico'])->name('expedientes.consultas.guardar_diagnostico');
});

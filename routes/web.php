<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AntecedenteController;
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

    // Módulo Expedientes — Listado y búsqueda
    Route::get('/expedientes', [ExpedienteController::class, 'index'])->name('expedientes.index');
    Route::get('/expedientes/buscar-ajax', [ExpedienteController::class, 'buscarAjax'])->name('expedientes.buscar_ajax');
    Route::get('/expedientes/{id}', [ExpedienteController::class, 'show'])->name('expedientes.show');
    Route::get('/expedientes/{id}/consultas', [ConsultaController::class, 'show'])->name('expedientes.consultas');

    // Detalle de consulta — Diagnóstico
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}', [ConsultaController::class, 'detalle'])->name('expedientes.consultas.detalle');
    Route::post('/expedientes/{mascota_id}/consultas/{consulta_id}/diagnostico', [ConsultaController::class, 'guardarDiagnostico'])->name('expedientes.consultas.guardar_diagnostico');

    // Tratamiento de la consulta
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}/tratamiento', [ConsultaController::class, 'tratamiento'])->name('expedientes.consultas.tratamiento');
    Route::post('/expedientes/{mascota_id}/consultas/{consulta_id}/tratamiento', [ConsultaController::class, 'guardarTratamiento'])->name('expedientes.consultas.guardar_tratamiento');

    // Antecedentes — Alergias (por mascota)
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}/alergias', [AntecedenteController::class, 'alergias'])->name('expedientes.consultas.alergias');
    Route::post('/expedientes/{mascota_id}/consultas/{consulta_id}/alergias', [AntecedenteController::class, 'guardarAlergia'])->name('expedientes.consultas.alergias.guardar');
    Route::delete('/expedientes/{mascota_id}/consultas/{consulta_id}/alergias/{alergia_id}', [AntecedenteController::class, 'eliminarAlergia'])->name('expedientes.consultas.alergias.eliminar');

    // Antecedentes — Lesiones (por mascota)
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}/lesiones', [AntecedenteController::class, 'lesiones'])->name('expedientes.consultas.lesiones');
    Route::post('/expedientes/{mascota_id}/consultas/{consulta_id}/lesiones', [AntecedenteController::class, 'guardarLesion'])->name('expedientes.consultas.lesiones.guardar');
    Route::delete('/expedientes/{mascota_id}/consultas/{consulta_id}/lesiones/{lesion_id}', [AntecedenteController::class, 'eliminarLesion'])->name('expedientes.consultas.lesiones.eliminar');

    // Antecedentes — Patológicos (por mascota)
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}/patologicos', [AntecedenteController::class, 'patologicos'])->name('expedientes.consultas.patologicos');
    Route::post('/expedientes/{mascota_id}/consultas/{consulta_id}/patologicos', [AntecedenteController::class, 'guardarPatologico'])->name('expedientes.consultas.patologicos.guardar');
    Route::delete('/expedientes/{mascota_id}/consultas/{consulta_id}/patologicos/{patologico_id}', [AntecedenteController::class, 'eliminarPatologico'])->name('expedientes.consultas.patologicos.eliminar');

    // Historial — Alimentación (por mascota)
    Route::get('/expedientes/{mascota_id}/consultas/{consulta_id}/alimentacion', [AntecedenteController::class, 'alimentacion'])->name('expedientes.consultas.alimentacion');
    Route::post('/expedientes/{mascota_id}/consultas/{consulta_id}/alimentacion', [AntecedenteController::class, 'guardarAlimentacion'])->name('expedientes.consultas.alimentacion.guardar');
    Route::delete('/expedientes/{mascota_id}/consultas/{consulta_id}/alimentacion/{registro_id}', [AntecedenteController::class, 'eliminarAlimentacion'])->name('expedientes.consultas.alimentacion.eliminar');
});

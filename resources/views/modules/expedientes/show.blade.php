@extends('layouts.main')

@section('titulo_pagina', 'Expediente Médico - ' . $mascota->nombre)
@section('hide_sidebar', true)

@section('contenido')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-folder-open text-primary mr-2"></i>Expediente Clínico: {{ $mascota->nombre }}
        </h1>
        <div>
            <a href="#" class="btn btn-success btn-sm shadow-sm mr-2">
                <i class="fas fa-plus mr-1"></i> Nueva Consulta
            </a>
            <a href="{{ route('expedientes.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Regresar al Buscador
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Tarjeta de Datos de la Mascota y Dueño -->
        <div class="col-lg-4 mb-4">
            <!-- Datos Mascota -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-paw mr-1"></i> Datos del Paciente
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-dog fa-4x text-gray-300"></i>
                    </div>
                    <table class="table table-sm table-borderless text-gray-900">
                        <tbody>
                            <tr>
                                <th width="45%">Folio / ID:</th>
                                <td>#{{ $mascota->id }}</td>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <td class="font-weight-bold text-primary">{{ $mascota->nombre }}</td>
                            </tr>
                            <tr>
                                <th>Especie:</th>
                                <td><span class="badge badge-info">{{ $mascota->especie }}</span></td>
                            </tr>
                            <tr>
                                <th>Raza:</th>
                                <td>{{ $mascota->raza ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Nacimiento:</th>
                                <td>{{ $mascota->fecha_nacimiento ? $mascota->fecha_nacimiento->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Tipo Sangre:</th>
                                <td>{{ $mascota->tipo_sangre ?? 'Desconocido' }}</td>
                            </tr>
                            <tr>
                                <th>Comportamiento:</th>
                                <td>{{ $mascota->comportamiento ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Adoptado:</th>
                                <td>
                                    @if($mascota->es_adoptado)
                                        <span class="badge badge-success">Sí</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Datos Propietario -->
            <div class="card shadow">
                <div class="card-header py-3 bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-user-circle mr-1"></i> Propietario
                    </h6>
                </div>
                <div class="card-body text-gray-900">
                    <h5 class="font-weight-bold text-gray-800">{{ $mascota->dueno->nombre_completo ?? 'Sin Dueño' }}</h5>
                    <p class="mb-1"><i class="fas fa-phone mr-2 text-info"></i> {{ $mascota->dueno->telefono ?? 'N/A' }}</p>
                    <p class="mb-0"><i class="fas fa-map-marker-alt mr-2 text-danger"></i> <small>{{ $mascota->dueno->direccion ?? 'N/A' }}</small></p>
                </div>
            </div>
        </div>

        <!-- Historial de Consultas -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history mr-1"></i> Historial Clínico de Consultas
                    </h6>
                    <span class="badge badge-primary">{{ $mascota->consultas->count() }} consultas</span>
                </div>
                <div class="card-body">
                    @if($mascota->consultas->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-file-medical fa-3x mb-3 text-gray-300"></i>
                            <p>No se han registrado consultas médicas en este expediente.</p>
                        </div>
                    @else
                        <div class="timeline">
                            @foreach($mascota->consultas->sortByDesc('fecha_consulta') as $consulta)
                                <div class="card border-left-info shadow-sm mb-4">
                                    <div class="card-header py-2 bg-light d-flex justify-content-between align-items-center">
                                        <span class="font-weight-bold text-info">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ $consulta->fecha_consulta->format('d/m/Y - h:i A') }}
                                        </span>
                                        <small class="text-muted">
                                            Atendido por: <strong>{{ $consulta->veterinario->nombre_completo ?? 'Dr. Especialista' }}</strong>
                                        </small>
                                    </div>
                                    <div class="card-body py-3 text-gray-900">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <small class="text-uppercase text-muted font-weight-bold">Peso:</small>
                                                <p class="mb-0 font-weight-bold">{{ $consulta->peso ? $consulta->peso . ' kg' : 'No registrado' }}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <small class="text-uppercase text-muted font-weight-bold">Talla (Altura):</small>
                                                <p class="mb-0 font-weight-bold">{{ $consulta->talla ? $consulta->talla . ' cm' : 'No registrado' }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

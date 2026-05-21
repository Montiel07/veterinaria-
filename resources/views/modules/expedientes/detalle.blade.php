@extends('layouts.main')

@section('titulo_pagina', 'Detalle de Consulta - ' . $mascota->nombre)

@section('contenido')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-stethoscope text-primary mr-2"></i>Detalle de Consulta Médica
        </h1>
        <a href="{{ route('expedientes.consultas', $mascota->id) }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Regresar a Consultas
        </a>
    </div>

    <div class="row">
        <!-- Datos de la Mascota y Dueño (Sidebar Interno) -->
        <div class="col-lg-4 mb-4">
            <!-- Paciente Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-paw mr-1"></i> Paciente
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-dog fa-3x text-gray-300"></i>
                    </div>
                    <table class="table table-sm table-borderless text-gray-900 mb-0">
                        <tbody>
                            <tr>
                                <th width="40%">Folio:</th>
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
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Propietario Card -->
            <div class="card shadow">
                <div class="card-header py-3 bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-user mr-1"></i> Propietario
                    </h6>
                </div>
                <div class="card-body text-gray-900">
                    <h6 class="font-weight-bold mb-2">{{ $mascota->dueno->nombre_completo ?? 'Sin Dueño' }}</h6>
                    <p class="mb-1"><i class="fas fa-phone text-info mr-2"></i> {{ $mascota->dueno->telefono ?? 'N/A' }}</p>
                    <p class="mb-0"><i class="fas fa-map-marker-alt text-danger mr-2"></i> <small>{{ $mascota->dueno->direccion ?? 'N/A' }}</small></p>
                </div>
            </div>
        </div>

        <!-- Detalles de la Consulta Seleccionada & Antecedentes -->
        <div class="col-lg-8 mb-4">
            <!-- Consulta Principal Card -->
            <div class="card shadow border-left-primary mb-4">
                <div class="card-header py-3 bg-light d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar-check mr-1"></i> Consulta del {{ $consultaSeleccionada->fecha_consulta->format('d/m/Y - h:i A') }}
                    </h6>
                    <span class="badge badge-primary text-white">Atendido</span>
                </div>
                <div class="card-body text-gray-900">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <small class="text-uppercase text-muted font-weight-bold d-block">Médico Veterinario:</small>
                            <span class="font-weight-bold text-gray-800"><i class="fas fa-user-md mr-1 text-primary"></i> {{ $consultaSeleccionada->veterinario->nombre_completo ?? 'Dr. Especialista' }}</span>
                        </div>
                        <div class="col-sm-3 col-6">
                            <small class="text-uppercase text-muted font-weight-bold d-block">Peso:</small>
                            <span class="font-weight-bold">{{ $consultaSeleccionada->peso ? $consultaSeleccionada->peso . ' kg' : 'N/A' }}</span>
                        </div>
                        <div class="col-sm-3 col-6">
                            <small class="text-uppercase text-muted font-weight-bold d-block">Talla (Altura):</small>
                            <span class="font-weight-bold">{{ $consultaSeleccionada->talla ? $consultaSeleccionada->talla . ' cm' : 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Antecedentes Card -->
            <div class="card shadow">
                <div class="card-header py-3 bg-light d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-secondary">
                        <i class="fas fa-history mr-1"></i> Antecedentes Clínicos (Otras Consultas)
                    </h6>
                    <span class="badge badge-secondary">{{ $antecedentes->count() }} Registros</span>
                </div>
                <div class="card-body">
                    @if($antecedentes->isEmpty())
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-folder mr-2"></i> No se registran consultas anteriores (antecedentes) para esta mascota.
                        </div>
                    @else
                        <div class="list-group list-group-flush text-gray-900">
                            @foreach($antecedentes as $ant)
                                <div class="list-group-item py-3 px-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 font-weight-bold text-gray-800">
                                            <i class="fas fa-calendar-alt text-info mr-1"></i> {{ $ant->fecha_consulta->format('d/m/Y - h:i A') }}
                                        </h6>
                                        <p class="mb-0 text-muted small">
                                            Diagnóstico: <span class="font-italic">"{{ Str::limit($ant->diagnostico, 90) }}"</span>
                                        </p>
                                    </div>
                                    <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $ant->id]) }}" class="btn btn-outline-info btn-sm shadow-sm">
                                        <i class="fas fa-folder-open mr-1"></i> Revisar
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

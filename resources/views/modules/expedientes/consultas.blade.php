@extends('layouts.main')

@section('titulo_pagina', 'Consultas de ' . $mascota->nombre)
@section('hide_sidebar', true)

@section('contenido')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-notes-medical text-info mr-2"></i>Consultas: {{ $mascota->nombre }}
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
        <!-- Datos Resumidos de la Mascota -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-paw mr-1"></i> Paciente & Propietario
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
                                <th>Mascota:</th>
                                <td class="font-weight-bold text-info">{{ $mascota->nombre }}</td>
                            </tr>
                            <tr>
                                <th>Especie:</th>
                                <td>{{ $mascota->especie }} ({{ $mascota->raza ?? 'Sin raza' }})</td>
                            </tr>
                            <tr>
                                <th>Dueño:</th>
                                <td>{{ $mascota->dueno->nombre_completo ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Teléfono:</th>
                                <td>{{ $mascota->dueno->telefono ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Historial de Consultas -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-light d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-history mr-1"></i> Historial de Consultas Médicas
                    </h6>
                    <span class="badge badge-info text-white px-2 py-1">{{ $mascota->consultas->count() }} Registros</span>
                </div>
                <div class="card-body">
                    @if($mascota->consultas->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-file-medical fa-3x mb-3 text-gray-300"></i>
                            <p>No se han registrado consultas médicas para esta mascota.</p>
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
                                        <div>
                                            <small class="text-muted mr-3">
                                                Médico: <strong>{{ $consulta->veterinario->nombre_completo ?? 'Dr. Especialista' }}</strong>
                                            </small>
                                            <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $consulta->id]) }}" class="btn btn-info btn-sm shadow-sm font-weight-bold">
                                                <i class="fas fa-eye mr-1"></i> Ver Detalle
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body py-3 text-gray-900">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <small class="text-uppercase text-muted font-weight-bold">Peso:</small>
                                                <p class="mb-0 font-weight-bold">{{ $consulta->peso ? $consulta->peso . ' kg' : 'N/A' }}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <small class="text-uppercase text-muted font-weight-bold">Talla:</small>
                                                <p class="mb-0 font-weight-bold">{{ $consulta->talla ? $consulta->talla . ' cm' : 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-uppercase text-muted font-weight-bold">Diagnóstico:</small>
                                            <p class="mb-0 bg-light p-2 rounded border-left border-info font-italic">
                                                {{ $consulta->diagnostico }}
                                            </p>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted font-weight-bold">Tratamiento / Indicaciones:</small>
                                            <p class="mb-0 bg-light p-2 rounded border-left border-success">
                                                {{ $consulta->tratamiento }}
                                            </p>
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

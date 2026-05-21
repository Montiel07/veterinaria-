@extends('layouts.main')

@section('titulo_pagina', 'Diagnóstico - ' . $mascota->nombre)

@php
    $consultaNumero = $mascota->consultas->sortBy('fecha_consulta')->values()->search(fn($c) => $c->id === $consulta->id) + 1;
@endphp

@section('estilos')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #f8fafc !important;
        }
        .content-container {
            padding: 1.5rem 0;
        }
        .page-title {
            font-size: 2rem;
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 1.5rem;
            letter-spacing: -0.03rem;
        }
        .breadcrumbs-card {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
            margin-bottom: 1.5rem;
        }
        .breadcrumbs-content {
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #94a3b8;
        }
        .breadcrumbs-content a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.15s ease;
        }
        .breadcrumbs-content a:hover {
            color: #475569;
        }
        .breadcrumbs-content .separator {
            margin: 0 0.5rem;
            color: #cbd5e1;
        }
        .breadcrumbs-content .active-item {
            color: #475569;
            font-weight: 500;
        }
        .patient-card {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-left: 5px solid #3b82f6 !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
            margin-bottom: 1.5rem;
        }
        .patient-card-body {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .patient-info {
            display: flex;
            align-items: center;
        }
        .paw-icon-container {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.25rem;
        }
        .paw-icon-container i {
            color: #3b82f6 !important;
            font-size: 1.25rem;
        }
        .patient-name {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.15rem;
            letter-spacing: -0.02rem;
        }
        .patient-sub {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
        }
        .badge-consultation {
            background-color: #3b82f6 !important;
            color: #ffffff !important;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 0.6rem 1.25rem;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.15);
            text-decoration: none;
        }
        .badge-consultation i {
            font-size: 0.875rem;
        }
        .editor-card {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
            margin-bottom: 2rem;
        }
        .editor-card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0 !important;
            background-color: #ffffff !important;
        }
        .editor-card-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #3b82f6;
            display: flex;
            align-items: center;
        }
        .editor-card-title i {
            font-size: 1rem;
        }
        .editor-card-body {
            padding: 1.5rem;
        }
        .form-control-custom {
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 1.1rem !important;
            color: #1e293b !important;
            line-height: 1.6 !important;
            padding: 1rem !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease !important;
            min-height: 250px;
        }
        .form-control-custom:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
            outline: none !important;
        }
        .btn-custom-save {
            background-color: #3b82f6 !important;
            border: 1px solid #3b82f6 !important;
            color: #ffffff !important;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.15);
            cursor: pointer;
        }
        .btn-custom-save:hover {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.25);
        }
        .btn-custom-save i {
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('contenido')
    <div class="content-container">
        <!-- Page Title -->
        <h1 class="page-title">Diagnóstico</h1>

        <!-- Breadcrumbs Container -->
        <div class="breadcrumbs-card">
            <div class="breadcrumbs-content">
                <a href="{{ route('expedientes.index') }}">Expedientes</a>
                <span class="separator">/</span>
                <a href="{{ route('expedientes.show', $mascota->id) }}">{{ $mascota->nombre }}</a>
                <span class="separator">/</span>
                <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $consulta->id]) }}">Consulta #{{ $consultaNumero }}</a>
                <span class="separator">/</span>
                <span class="active-item">Diagnóstico</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius: 8px; border-left: 4px solid #10b981;">
                <i class="fas fa-check-circle mr-2 text-emerald-500"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Pet Info Card -->
        <div class="patient-card">
            <div class="patient-card-body">
                <div class="patient-info">
                    <div class="paw-icon-container">
                        <i class="fas fa-paw"></i>
                    </div>
                    <div>
                        <h4 class="patient-name">{{ $mascota->nombre }}</h4>
                        <p class="patient-sub">
                            Folio #{{ $mascota->id }} <span class="mx-1">•</span> {{ $mascota->especie }} / {{ $mascota->raza ?? 'Mestizo' }}
                        </p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $consulta->id]) }}" class="badge-consultation">
                        <i class="fas fa-calendar-alt mr-2"></i> Consulta del {{ $consulta->fecha_consulta->format('d/m/Y') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Diagnostic Form Card -->
        <div class="editor-card">
            <div class="editor-card-header">
                <h6 class="editor-card-title">
                    <i class="fas fa-clipboard-list mr-2"></i> Diagnóstico de la Consulta
                </h6>
            </div>
            <div class="editor-card-body">
                <form action="{{ route('expedientes.consultas.guardar_diagnostico', [$mascota->id, $consulta->id]) }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <textarea name="diagnostico" id="diagnostico" rows="8" class="form-control form-control-custom shadow-sm" placeholder="Escriba el diagnóstico de la consulta aquí...">{{ old('diagnostico', strip_tags($consulta->diagnostico)) }}</textarea>
                        @error('diagnostico')
                            <small class="text-danger font-weight-bold mt-2 d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn-custom-save shadow-sm">
                            <i class="fas fa-save mr-2"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

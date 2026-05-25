@extends('layouts.main')

@section('titulo_pagina', 'Alergias - ' . $mascota->nombre)

@php
    $consultaNumero = $mascota->consultas->sortBy('fecha_consulta')->values()->search(fn($c) => $c->id === $consultaSeleccionada->id) + 1;
@endphp

@section('estilos')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif !important; background-color: #f8fafc !important; }
        .content-container { padding: 1.5rem 0; }
        .page-title { font-size: 2rem; font-weight: 500; color: #1e293b; margin-bottom: 1.5rem; letter-spacing: -.03rem; }
        .breadcrumbs-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 3px 0 rgba(0,0,0,.05); margin-bottom: 1.5rem; }
        .breadcrumbs-content { padding: .75rem 1.25rem; font-size: .875rem; font-weight: 500; color: #94a3b8; }
        .breadcrumbs-content a { color: #94a3b8; text-decoration: none; }
        .breadcrumbs-content a:hover { color: #475569; }
        .breadcrumbs-content .separator { margin: 0 .5rem; color: #cbd5e1; }
        .breadcrumbs-content .active-item { color: #475569; }
        .patient-card { background: #fff !important; border: 1px solid #e2e8f0 !important; border-left: 5px solid #f59e0b !important; border-radius: 8px !important; box-shadow: 0 1px 3px 0 rgba(0,0,0,.05) !important; margin-bottom: 1.5rem; }
        .patient-card-body { padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; }
        .patient-info { display: flex; align-items: center; }
        .paw-icon-container { width: 48px; height: 48px; border-radius: 50%; background: #fffbeb; display: flex; align-items: center; justify-content: center; margin-right: 1.25rem; }
        .paw-icon-container i { color: #f59e0b !important; font-size: 1.25rem; }
        .patient-name { font-size: 1.35rem; font-weight: 700; color: #1e293b; margin-bottom: .15rem; }
        .patient-sub { font-size: .85rem; color: #64748b; font-weight: 500; }
        .badge-consulta { background: #f59e0b !important; color: #fff !important; font-weight: 500; font-size: .85rem; padding: .6rem 1.25rem; border-radius: 6px; display: inline-flex; align-items: center; text-decoration: none; }
        .section-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 3px 0 rgba(0,0,0,.05); margin-bottom: 1.5rem; }
        .section-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; }
        .section-card-title { font-size: 1rem; font-weight: 600; color: #f59e0b; margin: 0; display: flex; align-items: center; }
        .section-card-body { padding: 1.5rem; }
        .form-label-custom { font-size: .8rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .04rem; margin-bottom: .4rem; display: block; }
        .form-control-custom { width: 100%; padding: .6rem .9rem; border: 1px solid #e2e8f0; border-radius: 6px; font-size: .9rem; color: #1e293b; transition: border-color .2s; background: #fff; }
        .form-control-custom:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,.1); outline: none; }
        .btn-agregar { background: #f59e0b; border: none; color: #fff; font-weight: 500; font-size: .875rem; padding: .6rem 1.25rem; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; transition: background .2s; }
        .btn-agregar:hover { background: #d97706; }
        .registro-item { background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 1.1rem 1.25rem; margin-bottom: .75rem; display: flex; justify-content: space-between; align-items: flex-start; }
        .registro-item-info h6 { font-size: .95rem; font-weight: 600; color: #1e293b; margin-bottom: .25rem; }
        .registro-item-info small { color: #78716c; font-size: .8rem; }
        .badge-tipo { background: #fef3c7; color: #92400e; font-size: .75rem; font-weight: 600; padding: .2rem .6rem; border-radius: 20px; margin-left: .5rem; }
        .badge-severidad-leve { background: #d1fae5; color: #065f46; font-size: .75rem; font-weight: 600; padding: .2rem .6rem; border-radius: 20px; }
        .badge-severidad-moderada { background: #fef3c7; color: #92400e; font-size: .75rem; font-weight: 600; padding: .2rem .6rem; border-radius: 20px; }
        .badge-severidad-severa { background: #fee2e2; color: #991b1b; font-size: .75rem; font-weight: 600; padding: .2rem .6rem; border-radius: 20px; }
        .btn-eliminar { background: none; border: none; color: #ef4444; font-size: .85rem; cursor: pointer; padding: .35rem .6rem; border-radius: 6px; transition: background .2s; }
        .btn-eliminar:hover { background: #fee2e2; }
        .empty-state { text-align: center; padding: 3rem 1rem; color: #94a3b8; }
        .empty-state i { font-size: 2.5rem; color: #e2e8f0; margin-bottom: .75rem; }
    </style>
@endsection

@section('contenido')
<div class="content-container">
    <h1 class="page-title">Alergias</h1>

    <div class="breadcrumbs-card">
        <div class="breadcrumbs-content">
            <a href="{{ route('expedientes.index') }}">Expedientes</a>
            <span class="separator">/</span>
            <a href="{{ route('expedientes.show', $mascota->id) }}">{{ $mascota->nombre }}</a>
            <span class="separator">/</span>
            <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $consultaSeleccionada->id]) }}">Consulta #{{ $consultaNumero }}</a>
            <span class="separator">/</span>
            <span class="active-item">Alergias</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert" style="border-radius:8px;border-left:4px solid #10b981;">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="patient-card">
        <div class="patient-card-body">
            <div class="patient-info">
                <div class="paw-icon-container"><i class="fas fa-paw"></i></div>
                <div>
                    <h4 class="patient-name">{{ $mascota->nombre }}</h4>
                    <p class="patient-sub">Folio #{{ $mascota->id }} <span class="mx-1">•</span> {{ $mascota->especie }} / {{ $mascota->raza ?? 'Mestizo' }}</p>
                </div>
            </div>
            <span class="badge-consulta"><i class="fas fa-calendar-alt mr-2"></i> Consulta del {{ $consultaSeleccionada->fecha_consulta->format('d/m/Y') }}</span>
        </div>
    </div>

    {{-- Formulario para agregar nueva alergia --}}
    <div class="section-card">
        <div class="section-card-header">
            <h6 class="section-card-title"><i class="fas fa-plus-circle mr-2"></i> Registrar Nueva Alergia</h6>
            <small class="text-muted">Los antecedentes se guardan en el expediente permanente de la mascota</small>
        </div>
        <div class="section-card-body">
            <form action="{{ route('expedientes.consultas.alergias.guardar', [$mascota->id, $consultaSeleccionada->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label class="form-label-custom">Descripción <span class="text-danger">*</span></label>
                        <input type="text" name="descripcion" class="form-control-custom" placeholder="Ej. Alergia a la penicilina" value="{{ old('descripcion') }}" required>
                        @error('descripcion')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label-custom">Tipo</label>
                        <select name="tipo" class="form-control-custom">
                            <option value="">Sin especificar</option>
                            <option value="Alimentaria" {{ old('tipo') == 'Alimentaria' ? 'selected' : '' }}>Alimentaria</option>
                            <option value="Medicamento" {{ old('tipo') == 'Medicamento' ? 'selected' : '' }}>Medicamento</option>
                            <option value="Ambiental" {{ old('tipo') == 'Ambiental' ? 'selected' : '' }}>Ambiental</option>
                            <option value="Contacto" {{ old('tipo') == 'Contacto' ? 'selected' : '' }}>Contacto</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label-custom">Severidad</label>
                        <select name="severidad" class="form-control-custom">
                            <option value="">Sin especificar</option>
                            <option value="Leve" {{ old('severidad') == 'Leve' ? 'selected' : '' }}>Leve</option>
                            <option value="Moderada" {{ old('severidad') == 'Moderada' ? 'selected' : '' }}>Moderada</option>
                            <option value="Severa" {{ old('severidad') == 'Severa' ? 'selected' : '' }}>Severa</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label-custom">Fecha detección</label>
                        <input type="date" name="fecha_deteccion" class="form-control-custom" value="{{ old('fecha_deteccion') }}">
                    </div>
                    <div class="col-md-10 mb-3">
                        <label class="form-label-custom">Notas adicionales</label>
                        <input type="text" name="notas" class="form-control-custom" placeholder="Observaciones..." value="{{ old('notas') }}">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn-agregar w-100">
                            <i class="fas fa-plus mr-1"></i> Agregar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Listado de alergias registradas --}}
    <div class="section-card">
        <div class="section-card-header">
            <h6 class="section-card-title"><i class="fas fa-hand-holding-medical mr-2"></i> Alergias Registradas</h6>
            <span style="background:#fef3c7;color:#92400e;font-size:.75rem;font-weight:600;padding:.2rem .75rem;border-radius:20px;">
                {{ $mascota->alergias->count() }} {{ $mascota->alergias->count() === 1 ? 'registro' : 'registros' }}
            </span>
        </div>
        <div class="section-card-body">
            @if($mascota->alergias->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-hand-holding-medical d-block"></i>
                    <p class="mb-0 font-weight-bold">No hay alergias registradas</p>
                    <small>Usa el formulario superior para agregar la primera alergia</small>
                </div>
            @else
                @foreach($mascota->alergias->sortByDesc('created_at') as $alergia)
                    <div class="registro-item">
                        <div class="registro-item-info">
                            <h6>
                                {{ $alergia->descripcion }}
                                @if($alergia->tipo) <span class="badge-tipo">{{ $alergia->tipo }}</span> @endif
                                @if($alergia->severidad)
                                    <span class="badge-severidad-{{ strtolower($alergia->severidad) }}">{{ $alergia->severidad }}</span>
                                @endif
                            </h6>
                            <small>
                                @if($alergia->fecha_deteccion) <i class="fas fa-calendar-alt mr-1"></i> {{ $alergia->fecha_deteccion->format('d/m/Y') }} &nbsp; @endif
                                @if($alergia->notas) <i class="fas fa-sticky-note mr-1"></i> {{ $alergia->notas }} @endif
                            </small>
                        </div>
                        <form action="{{ route('expedientes.consultas.alergias.eliminar', [$mascota->id, $consultaSeleccionada->id, $alergia->id]) }}" method="POST" onsubmit="return confirm('¿Eliminar esta alergia?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-eliminar" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

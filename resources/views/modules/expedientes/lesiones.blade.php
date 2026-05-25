@extends('layouts.main')
@section('titulo_pagina', 'Lesiones - ' . $mascota->nombre)
@php
    $consultaNumero = $mascota->consultas->sortBy('fecha_consulta')->values()->search(fn($c) => $c->id === $consultaSeleccionada->id) + 1;
@endphp
@section('estilos')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body{font-family:'Inter',sans-serif!important;background:#f8fafc!important}
    .content-container{padding:1.5rem 0}
    .page-title{font-size:2rem;font-weight:500;color:#1e293b;margin-bottom:1.5rem}
    .breadcrumbs-card{background:#fff;border:1px solid #e2e8f0;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.05);margin-bottom:1.5rem}
    .breadcrumbs-content{padding:.75rem 1.25rem;font-size:.875rem;color:#94a3b8}
    .breadcrumbs-content a{color:#94a3b8;text-decoration:none}
    .breadcrumbs-content a:hover{color:#475569}
    .breadcrumbs-content .separator{margin:0 .5rem;color:#cbd5e1}
    .breadcrumbs-content .active-item{color:#475569}
    .patient-card{background:#fff!important;border:1px solid #e2e8f0!important;border-left:5px solid #ef4444!important;border-radius:8px!important;box-shadow:0 1px 3px rgba(0,0,0,.05)!important;margin-bottom:1.5rem}
    .patient-card-body{padding:1.5rem;display:flex;align-items:center;justify-content:space-between}
    .patient-info{display:flex;align-items:center}
    .paw-icon-container{width:48px;height:48px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin-right:1.25rem}
    .paw-icon-container i{color:#ef4444!important;font-size:1.25rem}
    .patient-name{font-size:1.35rem;font-weight:700;color:#1e293b;margin-bottom:.15rem}
    .patient-sub{font-size:.85rem;color:#64748b}
    .badge-consulta{background:#ef4444!important;color:#fff!important;font-weight:500;font-size:.85rem;padding:.6rem 1.25rem;border-radius:6px;display:inline-flex;align-items:center}
    .section-card{background:#fff;border:1px solid #e2e8f0;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.05);margin-bottom:1.5rem}
    .section-card-header{padding:1rem 1.5rem;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between}
    .section-card-title{font-size:1rem;font-weight:600;color:#ef4444;margin:0;display:flex;align-items:center}
    .section-card-body{padding:1.5rem}
    .form-label-custom{font-size:.8rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.04rem;margin-bottom:.4rem;display:block}
    .form-control-custom{width:100%;padding:.6rem .9rem;border:1px solid #e2e8f0;border-radius:6px;font-size:.9rem;color:#1e293b;transition:border-color .2s;background:#fff}
    .form-control-custom:focus{border-color:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.1);outline:none}
    .btn-agregar{background:#ef4444;border:none;color:#fff;font-weight:500;font-size:.875rem;padding:.6rem 1.25rem;border-radius:6px;cursor:pointer;display:inline-flex;align-items:center;transition:background .2s}
    .btn-agregar:hover{background:#dc2626}
    .registro-item{background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:1.1rem 1.25rem;margin-bottom:.75rem;display:flex;justify-content:space-between;align-items:flex-start}
    .registro-item-info h6{font-size:.95rem;font-weight:600;color:#1e293b;margin-bottom:.25rem}
    .registro-item-info small{color:#78716c;font-size:.8rem}
    .badge-tag{font-size:.75rem;font-weight:600;padding:.2rem .6rem;border-radius:20px;margin-left:.5rem}
    .badge-tipo{background:#fee2e2;color:#991b1b}
    .badge-activa{background:#dcfce7;color:#166534}
    .badge-inactiva{background:#f1f5f9;color:#64748b}
    .btn-eliminar{background:none;border:none;color:#ef4444;font-size:.85rem;cursor:pointer;padding:.35rem .6rem;border-radius:6px;transition:background .2s}
    .btn-eliminar:hover{background:#fee2e2}
    .empty-state{text-align:center;padding:3rem 1rem;color:#94a3b8}
    .empty-state i{font-size:2.5rem;color:#e2e8f0;margin-bottom:.75rem;display:block}
</style>
@endsection

@section('contenido')
<div class="content-container">
    <h1 class="page-title">Lesiones</h1>
    <div class="breadcrumbs-card">
        <div class="breadcrumbs-content">
            <a href="{{ route('expedientes.index') }}">Expedientes</a><span class="separator">/</span>
            <a href="{{ route('expedientes.show', $mascota->id) }}">{{ $mascota->nombre }}</a><span class="separator">/</span>
            <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $consultaSeleccionada->id]) }}">Consulta #{{ $consultaNumero }}</a><span class="separator">/</span>
            <span class="active-item">Lesiones</span>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius:8px;border-left:4px solid #10b981;">
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
                    <p class="patient-sub mb-0">Folio #{{ $mascota->id }} • {{ $mascota->especie }} / {{ $mascota->raza ?? 'Mestizo' }}</p>
                </div>
            </div>
            <span class="badge-consulta"><i class="fas fa-calendar-alt mr-2"></i>Consulta del {{ $consultaSeleccionada->fecha_consulta->format('d/m/Y') }}</span>
        </div>
    </div>
    <div class="section-card">
        <div class="section-card-header">
            <h6 class="section-card-title"><i class="fas fa-plus-circle mr-2"></i> Registrar Nueva Lesión</h6>
            <small class="text-muted">Se guarda en el expediente permanente de la mascota</small>
        </div>
        <div class="section-card-body">
            <form action="{{ route('expedientes.consultas.lesiones.guardar', [$mascota->id, $consultaSeleccionada->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label class="form-label-custom">Descripción *</label>
                        <input type="text" name="descripcion" class="form-control-custom" placeholder="Ej. Fractura en pata delantera" value="{{ old('descripcion') }}" required>
                        @error('descripcion')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label-custom">Zona afectada</label>
                        <input type="text" name="zona_afectada" class="form-control-custom" placeholder="Ej. Pata delantera" value="{{ old('zona_afectada') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label-custom">Tipo</label>
                        <select name="tipo" class="form-control-custom">
                            <option value="">Sin especificar</option>
                            <option value="Traumática">Traumática</option>
                            <option value="Quirúrgica">Quirúrgica</option>
                            <option value="Dermatológica">Dermatológica</option>
                            <option value="Interna">Interna</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label-custom">Fecha registro</label>
                        <input type="date" name="fecha_registro" class="form-control-custom" value="{{ old('fecha_registro') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label-custom">Notas</label>
                        <input type="text" name="notas" class="form-control-custom" placeholder="Observaciones adicionales..." value="{{ old('notas') }}">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-center pt-3">
                        <input type="checkbox" name="activa" id="activa" value="1" checked style="margin-right:.5rem;width:16px;height:16px;">
                        <label for="activa" class="mb-0" style="font-size:.875rem;color:#475569;font-weight:500;">Activa</label>
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn-agregar w-100"><i class="fas fa-plus mr-1"></i> Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="section-card">
        <div class="section-card-header">
            <h6 class="section-card-title"><i class="fas fa-crutches mr-2"></i> Lesiones Registradas</h6>
            <span style="background:#fee2e2;color:#991b1b;font-size:.75rem;font-weight:600;padding:.2rem .75rem;border-radius:20px;">{{ $mascota->lesiones->count() }} registros</span>
        </div>
        <div class="section-card-body">
            @if($mascota->lesiones->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-crutches"></i>
                    <p class="mb-0 font-weight-bold">No hay lesiones registradas</p>
                    <small>Usa el formulario superior para agregar la primera lesión</small>
                </div>
            @else
                @foreach($mascota->lesiones->sortByDesc('created_at') as $lesion)
                    <div class="registro-item">
                        <div class="registro-item-info">
                            <h6>
                                {{ $lesion->descripcion }}
                                @if($lesion->tipo)<span class="badge-tag badge-tipo">{{ $lesion->tipo }}</span>@endif
                                @if($lesion->activa)<span class="badge-tag badge-activa">Activa</span>@else<span class="badge-tag badge-inactiva">Resuelta</span>@endif
                            </h6>
                            <small>
                                @if($lesion->zona_afectada)<i class="fas fa-map-marker-alt mr-1"></i>{{ $lesion->zona_afectada }} &nbsp;@endif
                                @if($lesion->fecha_registro)<i class="fas fa-calendar-alt mr-1"></i>{{ $lesion->fecha_registro->format('d/m/Y') }} &nbsp;@endif
                                @if($lesion->notas)<i class="fas fa-sticky-note mr-1"></i>{{ $lesion->notas }}@endif
                            </small>
                        </div>
                        <form action="{{ route('expedientes.consultas.lesiones.eliminar', [$mascota->id, $consultaSeleccionada->id, $lesion->id]) }}" method="POST" onsubmit="return confirm('¿Eliminar esta lesión?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-eliminar"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.main')
@section('titulo_pagina', 'Alimentación - ' . $mascota->nombre)
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
    .patient-card{background:#fff!important;border:1px solid #e2e8f0!important;border-left:5px solid #0ea5e9!important;border-radius:8px!important;box-shadow:0 1px 3px rgba(0,0,0,.05)!important;margin-bottom:1.5rem}
    .patient-card-body{padding:1.5rem;display:flex;align-items:center;justify-content:space-between}
    .patient-info{display:flex;align-items:center}
    .paw-icon-container{width:48px;height:48px;border-radius:50%;background:#f0f9ff;display:flex;align-items:center;justify-content:center;margin-right:1.25rem}
    .paw-icon-container i{color:#0ea5e9!important;font-size:1.25rem}
    .patient-name{font-size:1.35rem;font-weight:700;color:#1e293b;margin-bottom:.15rem}
    .patient-sub{font-size:.85rem;color:#64748b}
    .badge-consulta{background:#0ea5e9!important;color:#fff!important;font-weight:500;font-size:.85rem;padding:.6rem 1.25rem;border-radius:6px;display:inline-flex;align-items:center}
    .section-card{background:#fff;border:1px solid #e2e8f0;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.05);margin-bottom:1.5rem}
    .section-card-header{padding:1rem 1.5rem;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between}
    .section-card-title{font-size:1rem;font-weight:600;color:#0ea5e9;margin:0;display:flex;align-items:center}
    .section-card-body{padding:1.5rem}
    .form-label-custom{font-size:.8rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.04rem;margin-bottom:.4rem;display:block}
    .form-control-custom{width:100%;padding:.6rem .9rem;border:1px solid #e2e8f0;border-radius:6px;font-size:.9rem;color:#1e293b;transition:border-color .2s;background:#fff}
    .form-control-custom:focus{border-color:#0ea5e9;box-shadow:0 0 0 3px rgba(14,165,233,.1);outline:none}
    .btn-agregar{background:#0ea5e9;border:none;color:#fff;font-weight:500;font-size:.875rem;padding:.6rem 1.25rem;border-radius:6px;cursor:pointer;display:inline-flex;align-items:center;transition:background .2s}
    .btn-agregar:hover{background:#0284c7}
    .registro-item{background:#f0f9ff;border:1px solid #bae6fd;border-radius:8px;padding:1.1rem 1.25rem;margin-bottom:.75rem;display:flex;justify-content:space-between;align-items:flex-start}
    .registro-item-info h6{font-size:.95rem;font-weight:600;color:#1e293b;margin-bottom:.25rem}
    .registro-item-info small{color:#78716c;font-size:.8rem}
    .badge-tag{font-size:.75rem;font-weight:600;padding:.2rem .6rem;border-radius:20px;margin-left:.5rem;background:#e0f2fe;color:#075985}
    .btn-eliminar{background:none;border:none;color:#ef4444;font-size:.85rem;cursor:pointer;padding:.35rem .6rem;border-radius:6px;transition:background .2s}
    .btn-eliminar:hover{background:#fee2e2}
    .empty-state{text-align:center;padding:3rem 1rem;color:#94a3b8}
    .empty-state i{font-size:2.5rem;color:#e2e8f0;margin-bottom:.75rem;display:block}
</style>
@endsection

@section('contenido')
<div class="content-container">
    <h1 class="page-title">Historial de Alimentación</h1>
    <div class="breadcrumbs-card">
        <div class="breadcrumbs-content">
            <a href="{{ route('expedientes.index') }}">Expedientes</a><span class="separator">/</span>
            <a href="{{ route('expedientes.show', $mascota->id) }}">{{ $mascota->nombre }}</a><span class="separator">/</span>
            <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $consultaSeleccionada->id]) }}">Consulta #{{ $consultaNumero }}</a><span class="separator">/</span>
            <span class="active-item">Alimentación</span>
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
            <h6 class="section-card-title"><i class="fas fa-plus-circle mr-2"></i> Agregar Registro de Alimentación</h6>
            <small class="text-muted">Se guarda en el expediente permanente de la mascota</small>
        </div>
        <div class="section-card-body">
            <form action="{{ route('expedientes.consultas.alimentacion.guardar', [$mascota->id, $consultaSeleccionada->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label-custom">Tipo de alimento *</label>
                        <select name="tipo_alimento" class="form-control-custom" required>
                            <option value="">Seleccionar...</option>
                            <option value="Croquetas secas">Croquetas secas</option>
                            <option value="Alimento húmedo">Alimento húmedo</option>
                            <option value="Dieta casera">Dieta casera</option>
                            <option value="Mixta">Mixta (seca + húmeda)</option>
                            <option value="BARF">BARF (crudo)</option>
                            <option value="Suplemento">Suplemento</option>
                            <option value="Dieta prescrita">Dieta prescrita</option>
                        </select>
                        @error('tipo_alimento')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label-custom">Marca / Nombre</label>
                        <input type="text" name="marca" class="form-control-custom" placeholder="Ej. Royal Canin Medium" value="{{ old('marca') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label-custom">Frecuencia</label>
                        <input type="text" name="frecuencia" class="form-control-custom" placeholder="Ej. 2 veces/día" value="{{ old('frecuencia') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label-custom">Cantidad por comida</label>
                        <input type="text" name="cantidad_por_comida" class="form-control-custom" placeholder="Ej. 200g" value="{{ old('cantidad_por_comida') }}">
                    </div>
                    <div class="col-md-10 mb-3">
                        <label class="form-label-custom">Observaciones</label>
                        <input type="text" name="observaciones" class="form-control-custom" placeholder="Intolerancias, preferencias, indicaciones especiales..." value="{{ old('observaciones') }}">
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
            <h6 class="section-card-title"><i class="fas fa-utensils mr-2"></i> Historial de Alimentación</h6>
            <span style="background:#e0f2fe;color:#075985;font-size:.75rem;font-weight:600;padding:.2rem .75rem;border-radius:20px;">{{ $mascota->historialAlimentacion->count() }} registros</span>
        </div>
        <div class="section-card-body">
            @if($mascota->historialAlimentacion->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-utensils"></i>
                    <p class="mb-0 font-weight-bold">No hay registros de alimentación</p>
                    <small>Usa el formulario superior para agregar el primero</small>
                </div>
            @else
                @foreach($mascota->historialAlimentacion->sortByDesc('created_at') as $reg)
                    <div class="registro-item">
                        <div class="registro-item-info">
                            <h6>
                                {{ $reg->tipo_alimento }}
                                @if($reg->marca)<span class="badge-tag">{{ $reg->marca }}</span>@endif
                            </h6>
                            <small>
                                @if($reg->frecuencia)<i class="fas fa-clock mr-1"></i>{{ $reg->frecuencia }} &nbsp;@endif
                                @if($reg->cantidad_por_comida)<i class="fas fa-balance-scale mr-1"></i>{{ $reg->cantidad_por_comida }} &nbsp;@endif
                                @if($reg->observaciones)<i class="fas fa-sticky-note mr-1"></i>{{ $reg->observaciones }}@endif
                            </small>
                        </div>
                        <form action="{{ route('expedientes.consultas.alimentacion.eliminar', [$mascota->id, $consultaSeleccionada->id, $reg->id]) }}" method="POST" onsubmit="return confirm('¿Eliminar este registro?')">
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

@extends('layouts.main')

@section('titulo_pagina', 'Tratamiento - ' . $mascota->nombre)

@php
    $consultaNumero = $mascota->consultas->sortBy('fecha_consulta')->values()->search(fn($c) => $c->id === $consultaSeleccionada->id) + 1;
@endphp

@section('estilos')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif !important; background-color: #f8fafc !important; }
        .content-container { padding: 1.5rem 0; }
        .page-title { font-size: 2rem; font-weight: 500; color: #1e293b; margin-bottom: 1.5rem; letter-spacing: -0.03rem; }
        .breadcrumbs-card { background-color: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; box-shadow: 0 1px 3px 0 rgba(0,0,0,.05) !important; margin-bottom: 1.5rem; }
        .breadcrumbs-content { padding: .75rem 1.25rem; font-size: .875rem; font-weight: 500; color: #94a3b8; }
        .breadcrumbs-content a { color: #94a3b8; text-decoration: none; transition: color .15s ease; }
        .breadcrumbs-content a:hover { color: #475569; }
        .breadcrumbs-content .separator { margin: 0 .5rem; color: #cbd5e1; }
        .breadcrumbs-content .active-item { color: #475569; font-weight: 500; }
        .patient-card { background-color: #fff !important; border: 1px solid #e2e8f0 !important; border-left: 5px solid #10b981 !important; border-radius: 8px !important; box-shadow: 0 1px 3px 0 rgba(0,0,0,.05) !important; margin-bottom: 1.5rem; }
        .patient-card-body { padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; }
        .patient-info { display: flex; align-items: center; }
        .paw-icon-container { width: 48px; height: 48px; border-radius: 50%; background-color: #ecfdf5; display: flex; align-items: center; justify-content: center; margin-right: 1.25rem; }
        .paw-icon-container i { color: #10b981 !important; font-size: 1.25rem; }
        .patient-name { font-size: 1.35rem; font-weight: 700; color: #1e293b; margin-bottom: .15rem; letter-spacing: -.02rem; }
        .patient-sub { font-size: .85rem; color: #64748b; font-weight: 500; }
        .badge-consultation { background-color: #10b981 !important; color: #fff !important; font-weight: 500; font-size: .85rem; padding: .6rem 1.25rem; border-radius: 6px; display: inline-flex; align-items: center; box-shadow: 0 2px 4px rgba(16,185,129,.15); text-decoration: none; }
        .editor-card { background-color: #fff !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; box-shadow: 0 1px 3px 0 rgba(0,0,0,.05) !important; margin-bottom: 2rem; }
        .editor-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0 !important; background-color: #fff !important; }
        .editor-card-title { margin: 0; font-size: 1rem; font-weight: 600; color: #10b981; display: flex; align-items: center; }
        .editor-card-body { padding: 1.5rem; }
        .btn-custom-save { background-color: #10b981 !important; border: 1px solid #10b981 !important; color: #fff !important; font-weight: 500; font-size: .875rem; padding: .6rem 1.5rem; border-radius: 6px; transition: all .2s ease; display: inline-flex; align-items: center; box-shadow: 0 2px 4px rgba(16,185,129,.15); cursor: pointer; }
        .btn-custom-save:hover { background-color: #059669 !important; border-color: #059669 !important; }
        .ck-editor { box-shadow: 0 1px 3px 0 rgba(0,0,0,.05) !important; border-radius: 8px !important; overflow: hidden !important; margin-bottom: 1.5rem; }
        .ck.ck-toolbar { background-color: #f8fafc !important; border: 1px solid #e2e8f0 !important; border-bottom: 1px solid #cbd5e1 !important; padding: .5rem !important; }
        .ck-editor__editable_inline { min-height: 300px !important; font-family: 'Inter', sans-serif !important; font-size: 1.05rem !important; color: #1e293b !important; line-height: 1.7 !important; background-color: #fff !important; padding: 1.5rem !important; }
        .ck.ck-content { border: 1px solid #e2e8f0 !important; }
        .ck.ck-editor__main>.ck-editor__editable:focus { border-color: #10b981 !important; box-shadow: 0 0 0 3px rgba(16,185,129,.1) !important; outline: none !important; }
    </style>
@endsection

@section('contenido')
    <div class="content-container">
        <h1 class="page-title">Tratamiento</h1>

        <div class="breadcrumbs-card">
            <div class="breadcrumbs-content">
                <a href="{{ route('expedientes.index') }}">Expedientes</a>
                <span class="separator">/</span>
                <a href="{{ route('expedientes.show', $mascota->id) }}">{{ $mascota->nombre }}</a>
                <span class="separator">/</span>
                <a href="{{ route('expedientes.consultas.detalle', [$mascota->id, $consultaSeleccionada->id]) }}">Consulta #{{ $consultaNumero }}</a>
                <span class="separator">/</span>
                <span class="active-item">Tratamiento</span>
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
                <div>
                    <span class="badge-consultation">
                        <i class="fas fa-calendar-alt mr-2"></i> Consulta del {{ $consultaSeleccionada->fecha_consulta->format('d/m/Y') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="editor-card">
            <div class="editor-card-header">
                <h6 class="editor-card-title">
                    <i class="fas fa-briefcase-medical mr-2"></i> Tratamiento de la Consulta
                </h6>
            </div>
            <div class="editor-card-body">
                <form action="{{ route('expedientes.consultas.guardar_tratamiento', [$mascota->id, $consultaSeleccionada->id]) }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <textarea name="tratamiento" id="tratamiento" placeholder="Describa el tratamiento indicado para esta consulta...">{{ old('tratamiento', $consultaSeleccionada->tratamiento) }}</textarea>
                        @error('tratamiento')
                            <small class="text-danger font-weight-bold mt-2 d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn-custom-save shadow-sm">
                            <i class="fas fa-save mr-2"></i> Guardar Tratamiento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/translations/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor.create(document.querySelector('#tratamiento'), {
                language: 'es',
                toolbar: { items: ['heading','|','bold','italic','link','|','bulletedList','numberedList','outdent','indent','|','blockQuote','insertTable','|','undo','redo'] },
                placeholder: 'Describa el tratamiento indicado para esta consulta médica...'
            }).catch(error => console.error(error));
        });
    </script>
@endsection

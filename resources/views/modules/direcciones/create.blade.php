@extends('layouts.main')

@section('titulo_pagina', 'Nueva Dirección')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nueva Dirección</h1>
    <a href="{{ route('direcciones.index') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Regresar
    </a>
</div>

@include('layouts.partials.alerts')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Dirección</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('direcciones.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="calle">Calle <span class="text-danger">*</span></label>
                    <input type="text" name="calle" id="calle"
                        class="form-control @error('calle') is-invalid @enderror"
                        value="{{ old('calle') }}" placeholder="Ej. Av. Insurgentes 123">
                    @error('calle')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="colonia">Colonia <span class="text-danger">*</span></label>
                    <input type="text" name="colonia" id="colonia"
                        class="form-control @error('colonia') is-invalid @enderror"
                        value="{{ old('colonia') }}" placeholder="Ej. Centro">
                    @error('colonia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-5 form-group">
                    <label for="ciudad">Ciudad <span class="text-danger">*</span></label>
                    <input type="text" name="ciudad" id="ciudad"
                        class="form-control @error('ciudad') is-invalid @enderror"
                        value="{{ old('ciudad') }}" placeholder="Ej. Ciudad de México">
                    @error('ciudad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-5 form-group">
                    <label for="estado">Estado <span class="text-danger">*</span></label>
                    <input type="text" name="estado" id="estado"
                        class="form-control @error('estado') is-invalid @enderror"
                        value="{{ old('estado') }}" placeholder="Ej. CDMX">
                    @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2 form-group">
                    <label for="codigo_postal">C.P. <span class="text-danger">*</span></label>
                    <input type="text" name="codigo_postal" id="codigo_postal"
                        class="form-control @error('codigo_postal') is-invalid @enderror"
                        value="{{ old('codigo_postal') }}" placeholder="00000">
                    @error('codigo_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="referencias">Referencias</label>
                    <textarea name="referencias" id="referencias" rows="3"
                        class="form-control @error('referencias') is-invalid @enderror"
                        placeholder="Indicaciones adicionales para ubicar la dirección...">{{ old('referencias') }}</textarea>
                    @error('referencias')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Guardar
            </button>
            <a href="{{ route('direcciones.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>
    </div>
</div>

@endsection

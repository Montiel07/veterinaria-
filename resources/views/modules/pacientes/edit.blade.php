@extends('layouts.main')

@section('titulo_pagina', 'Editar Paciente')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Paciente</h1>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Regresar
    </a>
</div>

@include('layouts.partials.alerts')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Paciente</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="nombre">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" id="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $paciente->nombre) }}">
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 form-group">
                    <label for="especie">Especie <span class="text-danger">*</span></label>
                    <input type="text" name="especie" id="especie"
                        class="form-control @error('especie') is-invalid @enderror"
                        value="{{ old('especie', $paciente->especie) }}">
                    @error('especie')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 form-group">
                    <label for="raza">Raza</label>
                    <input type="text" name="raza" id="raza"
                        class="form-control @error('raza') is-invalid @enderror"
                        value="{{ old('raza', $paciente->raza) }}">
                    @error('raza')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 form-group">
                    <label for="sexo">Sexo <span class="text-danger">*</span></label>
                    <select name="sexo" id="sexo" class="form-control @error('sexo') is-invalid @enderror">
                        <option value="">Selecciona...</option>
                        <option value="Macho" {{ old('sexo', $paciente->sexo) === 'Macho' ? 'selected' : '' }}>Macho</option>
                        <option value="Hembra" {{ old('sexo', $paciente->sexo) === 'Hembra' ? 'selected' : '' }}>Hembra</option>
                    </select>
                    @error('sexo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                        class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                        value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}">
                    @error('fecha_nacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 form-group">
                    <label for="propietario">Propietario <span class="text-danger">*</span></label>
                    <input type="text" name="propietario" id="propietario"
                        class="form-control @error('propietario') is-invalid @enderror"
                        value="{{ old('propietario', $paciente->propietario) }}">
                    @error('propietario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono"
                        class="form-control @error('telefono') is-invalid @enderror"
                        value="{{ old('telefono', $paciente->telefono) }}">
                    @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="3"
                        class="form-control @error('observaciones') is-invalid @enderror">{{ old('observaciones', $paciente->observaciones) }}</textarea>
                    @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection

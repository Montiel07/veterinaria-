@extends('layouts.admin')

@section('titulo_pagina', 'Editar Usuario')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Usuario</h1>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Regresar
    </a>
</div>

@include('layouts.partials.alerts')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Usuario</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $usuario->name) }}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $usuario->email) }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="password">Nueva Contraseña <small class="text-muted">(dejar vacío para no cambiar)</small></label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Nueva contraseña">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="rol">Rol <span class="text-danger">*</span></label>
                    <select name="rol" id="rol" class="form-control @error('rol') is-invalid @enderror">
                        <option value="veterinario" {{ old('rol', $usuario->rol) == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                        <option value="administrador" {{ old('rol', $usuario->rol) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('rol')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control" placeholder="Repite la nueva contraseña">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Actualizar
            </button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection

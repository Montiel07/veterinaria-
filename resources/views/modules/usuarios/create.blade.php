@extends('layouts.admin')

@section('titulo_pagina', 'Nuevo Usuario')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nuevo Usuario</h1>
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
        <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Nombre completo">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="correo@ejemplo.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="password">Contraseña <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Mínimo 6 caracteres">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="rol">Rol <span class="text-danger">*</span></label>
                    <select name="rol" id="rol" class="form-control @error('rol') is-invalid @enderror">
                        <option value="veterinario" {{ old('rol') == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                        <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('rol')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="password_confirmation">Confirmar Contraseña <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control" placeholder="Repite la contraseña">
                </div>
            </div>

            <!-- Sección de Perfil Veterinario (Oculta por defecto) -->
            <div id="veterinario_fields" style="display: {{ old('rol') == 'veterinario' ? 'block' : 'none' }};">
                <hr>
                <h6 class="m-0 font-weight-bold text-primary mb-3">Perfil de Veterinario</h6>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nombre_completo">Nombre Completo (Profesional) <span class="text-danger">*</span></label>
                        <input type="text" name="nombre_completo" id="nombre_completo"
                            class="form-control @error('nombre_completo') is-invalid @enderror"
                            value="{{ old('nombre_completo') }}" placeholder="Dr. Nombre Apellido">
                        @error('nombre_completo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="especialidad">Especialidad <span class="text-danger">*</span></label>
                        <input type="text" name="especialidad" id="especialidad"
                            class="form-control @error('especialidad') is-invalid @enderror"
                            value="{{ old('especialidad') }}" placeholder="Ej. Cirugía General">
                        @error('especialidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="cedula_profesional">Cédula Profesional <span class="text-danger">*</span></label>
                        <input type="text" name="cedula_profesional" id="cedula_profesional"
                            class="form-control @error('cedula_profesional') is-invalid @enderror"
                            value="{{ old('cedula_profesional') }}" placeholder="Número de cédula">
                        @error('cedula_profesional')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="foto_firma">Foto / Firma (Opcional)</label>
                        <input type="file" name="foto_firma" id="foto_firma"
                            class="form-control-file @error('foto_firma') is-invalid @enderror" accept="image/*">
                        @error('foto_firma')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Guardar
            </button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/create.js') }}"></script>
@endsection

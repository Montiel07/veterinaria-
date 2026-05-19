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
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data">
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

            <!-- Sección de Perfil Veterinario (Oculta por defecto) -->
            <div id="veterinario_fields" style="display: {{ old('rol', $usuario->rol) == 'veterinario' ? 'block' : 'none' }};">
                <hr>
                <h6 class="m-0 font-weight-bold text-primary mb-3">Perfil de Veterinario</h6>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nombre_completo">Nombre Completo (Profesional) <span class="text-danger">*</span></label>
                        <input type="text" name="nombre_completo" id="nombre_completo"
                            class="form-control @error('nombre_completo') is-invalid @enderror"
                            value="{{ old('nombre_completo', optional($usuario->veterinario)->nombre_completo) }}" placeholder="Dr. Nombre Apellido">
                        @error('nombre_completo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="especialidad">Especialidad <span class="text-danger">*</span></label>
                        <input type="text" name="especialidad" id="especialidad"
                            class="form-control @error('especialidad') is-invalid @enderror"
                            value="{{ old('especialidad', optional($usuario->veterinario)->especialidad) }}" placeholder="Ej. Cirugía General">
                        @error('especialidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="cedula_profesional">Cédula Profesional <span class="text-danger">*</span></label>
                        <input type="text" name="cedula_profesional" id="cedula_profesional"
                            class="form-control @error('cedula_profesional') is-invalid @enderror"
                            value="{{ old('cedula_profesional', optional($usuario->veterinario)->cedula_profesional) }}" placeholder="Número de cédula">
                        @error('cedula_profesional')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="foto_firma">Actualizar Foto / Firma</label>
                        <input type="file" name="foto_firma" id="foto_firma"
                            class="form-control-file @error('foto_firma') is-invalid @enderror" accept="image/*">
                        @error('foto_firma')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        @if(optional($usuario->veterinario)->foto_firma)
                            <div class="mt-2">
                                <span class="text-muted small">Foto actual:</span><br>
                                <img src="{{ asset('storage/' . $usuario->veterinario->foto_firma) }}" alt="Foto" width="100" class="img-thumbnail mt-1">
                            </div>
                        @endif
                    </div>
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

@section('scripts')
    <script src="{{ asset('js/admin/create.js') }}"></script>
@endsection

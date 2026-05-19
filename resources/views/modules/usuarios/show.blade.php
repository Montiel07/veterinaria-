@extends('layouts.admin')

@section('titulo_pagina', 'Detalles de Usuario')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detalles de Usuario</h1>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm mr-1"></i> Regresar
    </a>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow mb-4 border-left-danger">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">Confirmar Eliminación</h6>
            </div>
            <div class="card-body">
                
                <h5 class="font-weight-bold mb-3">Datos del Usuario</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->name }}</li>
                    <li class="list-group-item"><strong>Correo:</strong> {{ $usuario->email }}</li>
                    <li class="list-group-item">
                        <strong>Rol:</strong> 
                        <span class="badge badge-{{ $usuario->rol === 'administrador' ? 'danger' : 'info' }}">
                            {{ ucfirst($usuario->rol) }}
                        </span>
                    </li>
                    <li class="list-group-item"><strong>Fecha de Registro:</strong> {{ $usuario->created_at->format('d/m/Y H:i') }}</li>
                </ul>

                @if($usuario->rol === 'veterinario' && $usuario->veterinario)
                <h5 class="font-weight-bold mb-3">Datos del Veterinario</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Nombre Profesional:</strong> {{ $usuario->veterinario->nombre_completo }}</li>
                    <li class="list-group-item"><strong>Especialidad:</strong> {{ $usuario->veterinario->especialidad }}</li>
                    <li class="list-group-item"><strong>Cédula:</strong> {{ $usuario->veterinario->cedula_profesional }}</li>
                </ul>
                @endif

                <hr>

                @if($hasDependencies)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-exclamation-circle"></i> No se puede eliminar</h4>
                        <p>Este usuario no puede ser eliminado porque tiene registros asociados en el sistema (ej. historial, pacientes, etc.). Eliminarlo causaría pérdida de información crítica.</p>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> ¡Advertencia!</h4>
                        <p>Estás a punto de eliminar este usuario del sistema. Esta acción <strong>no se podrá recuperar</strong> e incluirá la eliminación de su perfil y archivos asociados.</p>
                        <hr>
                        <p class="mb-0">¿Estás completamente seguro de que deseas continuar?</p>
                    </div>

                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-flex justify-content-end mt-3">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mr-2">Cancelar</a>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash mr-1"></i> Sí, Confirmar Eliminación
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

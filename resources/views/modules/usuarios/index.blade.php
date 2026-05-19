@extends('layouts.admin')

@section('titulo_pagina', 'Usuarios')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuevo Usuario
    </a>
</div>

@include('layouts.partials.alerts')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Usuarios</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Registrado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <span class="badge badge-{{ $usuario->rol === 'administrador' ? 'danger' : 'info' }}">
                                {{ ucfirst($usuario->rol) }}
                            </span>
                        </td>
                        <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('usuarios.edit', $usuario) }}"
                                class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if ($usuario->id !== auth()->id())
                            <form action="{{ route('usuarios.destroy', $usuario) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('¿Deseas eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $usuarios->links() }}
        </div>
    </div>
</div>

@endsection

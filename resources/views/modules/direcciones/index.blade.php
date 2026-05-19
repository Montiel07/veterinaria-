@extends('layouts.main')

@section('titulo_pagina', 'Direcciones')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Direcciones</h1>
    <a href="{{ route('direcciones.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nueva Dirección
    </a>
</div>

@include('layouts.partials.alerts')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Direcciones</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tablaDirecciones" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Calle</th>
                        <th>Colonia</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>C.P.</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($direcciones as $direccion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $direccion->calle }}</td>
                        <td>{{ $direccion->colonia }}</td>
                        <td>{{ $direccion->ciudad }}</td>
                        <td>{{ $direccion->estado }}</td>
                        <td>{{ $direccion->codigo_postal }}</td>
                        <td class="text-center">
                            <a href="{{ route('direcciones.edit', $direccion) }}"
                                class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('direcciones.destroy', $direccion) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('¿Deseas eliminar esta dirección?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay direcciones registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $direcciones->links() }}
        </div>
    </div>
</div>

@endsection

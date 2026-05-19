@extends('layouts.main')

@section('titulo_pagina', 'Pacientes')

@section('contenido')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pacientes</h1>
    <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Nuevo Paciente
    </a>
</div>

@include('layouts.partials.alerts')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Pacientes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Sexo</th>
                        <th>Propietario</th>
                        <th>Teléfono</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pacientes as $paciente)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $paciente->nombre }}</td>
                        <td>{{ $paciente->especie }}</td>
                        <td>{{ $paciente->raza ?? '—' }}</td>
                        <td>
                            <span class="badge badge-{{ $paciente->sexo === 'Macho' ? 'primary' : 'danger' }}">
                                {{ $paciente->sexo }}
                            </span>
                        </td>
                        <td>{{ $paciente->propietario }}</td>
                        <td>{{ $paciente->telefono ?? '—' }}</td>
                        <td class="text-center">
                            <a href="{{ route('pacientes.edit', $paciente) }}"
                                class="btn btn-warning btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pacientes.destroy', $paciente) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('¿Deseas eliminar este paciente?')">
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
                        <td colspan="8" class="text-center text-muted">No hay pacientes registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $pacientes->links() }}
        </div>
    </div>
</div>

@endsection

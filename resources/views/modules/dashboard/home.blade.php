@extends('layouts.main')

@section('titulo_pagina', 'Panel de Inicio')
@section('hide_sidebar', true)

@section('contenido')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de inicio</h1>
    </div>

    <!-- Welcome Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-home mr-1"></i> Bienvenido al sistema
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Hola, <strong>{{ Auth::user()->name }}</strong>.
                        Selecciona una opción del menú lateral para comenzar.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Espacio para la Imagen Principal -->
    <div class="row mt-4">
        <div class="col-12 text-center">
            <img src="{{ asset('img/logo_veterinaria.png') }}" alt="Logo Veterinaria Santa María" class="img-fluid" style="max-height: 400px; opacity: 0.9;">
        </div>
    </div>

@endsection

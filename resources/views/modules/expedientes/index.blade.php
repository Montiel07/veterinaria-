@extends('layouts.main')

@section('titulo_pagina', 'Expedientes Médicos')
@section('hide_sidebar', true)

@section('contenido')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Expedientes Médicos</h1>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-folder-open mr-1"></i> Gestión de Expedientes
                    </h6>
                </div>
                <div class="card-body text-center py-5">
                    
                    <h4 class="mb-4 text-gray-700 font-weight-bold">Buscador de Expedientes</h4>
                    <p class="text-muted mb-4">Ingrese el nombre de la mascota, nombre del propietario o teléfono para localizar el expediente médico.</p>

                    <div class="row justify-content-center mb-5">
                        <div class="col-md-8 col-lg-6 position-relative text-left">
                            <div class="input-group input-group-lg shadow-sm">
                                <input type="text" id="inputBuscar" class="form-control" placeholder="Buscar paciente por folio, mascota o dueño..." autocomplete="off" aria-label="Buscar expediente">
                                <div class="input-group-append">
                                    <button class="btn btn-primary px-4" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Contenedor flotante de resultados -->
                            <div id="resultadosBusqueda" class="list-group shadow position-absolute w-100 mt-1 d-none" style="z-index: 1000; max-height: 320px; overflow-y: auto;">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-center flex-wrap">
                        <button type="button" class="btn btn-info btn-lg m-2 shadow-sm" id="btnVerConsultas" disabled>
                            <i class="fas fa-notes-medical mr-2"></i> Ver Consultas
                        </button>
                        <button type="button" class="btn btn-success btn-lg m-2 shadow-sm">
                            <i class="fas fa-plus-circle mr-2"></i> Nuevo Paciente / Mascota
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let timeout = null;
    const $input = $('#inputBuscar');
    const $resultados = $('#resultadosBusqueda');
    const $btnVerConsultas = $('#btnVerConsultas');
    let selectedMascotaId = null;

    $input.on('input', function() {
        clearTimeout(timeout);
        const query = $(this).val().trim();

        if (query.length < 2) {
            $resultados.addClass('d-none').empty();
            $btnVerConsultas.prop('disabled', true);
            selectedMascotaId = null;
            return;
        }

        // Debounce de 300ms para evitar múltiples llamadas AJAX al teclear rápido
        timeout = setTimeout(function() {
            $.ajax({
                url: "{{ route('expedientes.buscar_ajax') }}",
                type: "GET",
                data: { q: query },
                success: function(data) {
                    $resultados.empty().removeClass('d-none');

                    if (data.length === 0) {
                        $resultados.append('<div class="list-group-item text-muted">No se encontraron mascotas o dueños.</div>');
                        return;
                    }

                    // Renderizar cada mascota encontrada
                    data.forEach(function(mascota) {
                        const itemHtml = `
                            <a href="#" class="list-group-item list-group-item-action py-3 item-mascota" data-id="${mascota.id}" data-nombre="${mascota.nombre}">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 font-weight-bold text-primary">
                                        <i class="fas fa-paw mr-1"></i> ${mascota.nombre}
                                        <span class="badge badge-secondary ml-1 font-weight-normal">${mascota.especie} - ${mascota.raza}</span>
                                    </h6>
                                    <small class="text-muted">Folio: #${mascota.id}</small>
                                </div>
                                <p class="mb-0 text-gray-800 small">
                                    <i class="fas fa-user-circle mr-1"></i> Dueño: <strong>${mascota.dueno}</strong>
                                </p>
                            </a>
                        `;
                        $resultados.append(itemHtml);
                    });
                },
                error: function() {
                    console.error("Error al procesar la búsqueda.");
                }
            });
        }, 300);
    });

    // Acción al seleccionar una mascota de la lista
    $(document).on('click', '.item-mascota', function(e) {
        e.preventDefault();
        selectedMascotaId = $(this).data('id');
        const nombreMascota = $(this).data('nombre');

        $input.val(nombreMascota);
        $resultados.addClass('d-none').empty();
        $btnVerConsultas.prop('disabled', false);
    });

    // Acción al hacer clic en "Ver Consultas"
    $btnVerConsultas.on('click', function() {
        if (selectedMascotaId) {
            window.location.href = `/expedientes/${selectedMascotaId}`;
        }
    });

    // Cerrar el buscador flotante si se hace clic afuera
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#inputBuscar, #resultadosBusqueda').length) {
            $resultados.addClass('d-none');
        }
    });
});
</script>
@endsection

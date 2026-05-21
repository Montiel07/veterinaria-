@php
    $currentMascotaId = isset($mascota) ? $mascota->id : null;
    $currentConsultaId = isset($consultaSeleccionada) ? $consultaSeleccionada->id : (isset($consulta) ? $consulta->id : null);
@endphp

<style>
    .custom-sidebar {
        background: linear-gradient(180deg, #3065e7 0%, #1a42b1 100%) !important;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
        border: none !important;
    }
    .custom-sidebar .sidebar-heading {
        color: rgba(255, 255, 255, 0.45) !important;
        font-weight: 800 !important;
        letter-spacing: 0.08rem !important;
        font-size: 0.7rem !important;
        padding-top: 1.5rem !important;
        padding-bottom: 0.5rem !important;
        text-transform: uppercase;
    }
    .custom-sidebar .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.7) !important;
        font-weight: 500 !important;
        padding: 0.8rem 1.5rem !important;
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
    }
    .custom-sidebar .nav-item .nav-link i {
        color: rgba(255, 255, 255, 0.5) !important;
        font-size: 1rem !important;
        margin-right: 0.85rem !important;
        width: 1.25rem;
        text-align: center;
        transition: all 0.2s ease;
    }
    .custom-sidebar .nav-item.active .nav-link {
        color: #ffffff !important;
        font-weight: 700 !important;
    }
    .custom-sidebar .nav-item.active .nav-link i {
        color: #ffffff !important;
    }
    .custom-sidebar .nav-item .nav-link:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.05);
    }
    .custom-sidebar .nav-item .nav-link:hover i {
        color: #ffffff !important;
    }
    .custom-sidebar .sidebar-brand {
        display: none !important;
    }
    .custom-sidebar .sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        margin: 0 !important;
    }
</style>

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion custom-sidebar" id="accordionSidebar">

    <!-- Heading - Consulta -->
    <div class="sidebar-heading">
        Consulta
    </div>

    <!-- Nav Item - Diagnóstico de la consulta -->
    <li class="nav-item {{ request()->routeIs('expedientes.consultas.detalle') || request()->routeIs('expedientes.consultas.diagnostico') ? 'active' : '' }}">
        <a class="nav-link" href="{{ $currentMascotaId && $currentConsultaId ? route('expedientes.consultas.detalle', [$currentMascotaId, $currentConsultaId]) : '#diagnostico' }}">
            <i class="fas fa-file-alt"></i>
            <span>Diagnóstico</span>
        </a>
    </li>

    <!-- Nav Item - Tratamiento de la consulta -->
    <li class="nav-item">
        <a class="nav-link" href="#tratamiento">
            <i class="fas fa-briefcase-medical"></i>
            <span>Tratamiento</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading - Antecedentes -->
    <div class="sidebar-heading">
        Antecedentes
    </div>

    <!-- Nav Item - Antecedentes Alergias -->
    <li class="nav-item">
        <a class="nav-link" href="#antecedentes_alergias">
            <i class="fas fa-hand-holding-medical"></i>
            <span>Alergias</span>
        </a>
    </li>

    <!-- Nav Item - Antecedentes Lesiones -->
    <li class="nav-item">
        <a class="nav-link" href="#antecedentes_lesiones">
            <i class="fas fa-crutches"></i>
            <span>Lesiones</span>
        </a>
    </li>

    <!-- Nav Item - Antecedentes Patológicos -->
    <li class="nav-item">
        <a class="nav-link" href="#antecedentes_patologicos">
            <i class="fas fa-heart"></i>
            <span>Patológicos</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading - Historial -->
    <div class="sidebar-heading">
        Historial
    </div>

    <!-- Nav Item - Historial Alimentación -->
    <li class="nav-item">
        <a class="nav-link" href="#historial_alimentacion">
            <i class="fas fa-utensils"></i>
            <span>Alimentación</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline mt-4">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: rgba(255, 255, 255, 0.15); color: white;"></button>
    </div>

</ul>
<!-- End of Sidebar -->

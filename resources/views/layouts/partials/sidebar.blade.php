<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Veterinaria</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Inicio -->
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Inicio</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading - Clínica -->
    <div class="sidebar-heading">
        Clínica
    </div>

    <!-- Nav Item - Direcciones -->
    <li class="nav-item {{ request()->routeIs('direcciones*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('direcciones.index') }}">
            <i class="fas fa-fw fa-map-marker-alt"></i>
            <span>Direcciones</span>
        </a>
    </li>

    <!-- Nav Item - Pacientes -->
    <li class="nav-item {{ request()->routeIs('pacientes*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pacientes.index') }}">
            <i class="fas fa-fw fa-dog"></i>
            <span>Pacientes</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading - Administración -->
    <div class="sidebar-heading">
        Administración
    </div>

    <!-- Nav Item - Usuarios -->
    <li class="nav-item {{ request()->routeIs('usuarios*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('usuarios.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

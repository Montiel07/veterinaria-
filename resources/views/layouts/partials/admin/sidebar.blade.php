<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home_admin') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('home_admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home_admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestión
    </div>

    <!-- Nav Item - Usuarios -->
    <li class="nav-item {{ request()->routeIs('usuarios*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('usuarios.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span>
        </a>
    </li>

    <!-- Nav Item - Clínicas / Sucursales (Opcional futuro) -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-building"></i>
            <span>Sucursales</span>
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

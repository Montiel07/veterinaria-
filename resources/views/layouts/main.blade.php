<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestión Veterinaria">
    <meta name="author" content="">

    <title>@yield('titulo_pagina', 'Veterinaria') - Sistema</title>

    <!-- Fontawesome -->
    <link href="{{ asset('startbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('startbootstrap/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @yield('estilos')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        {{-- Sidebar --}}
        @hasSection('hide_sidebar')
        @else
            @include('layouts.partials.sidebar')
        @endif

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- Topbar --}}
                @include('layouts.partials.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('contenido')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- Footer --}}
            @include('layouts.partials.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Modal de Logout --}}
    @include('layouts.partials.logout_modal')

    <!-- Bootstrap core JS -->
    <script src="{{ asset('startbootstrap/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JS -->
    <script src="{{ asset('startbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- SB Admin 2 JS -->
    <script src="{{ asset('startbootstrap/js/sb-admin-2.min.js') }}"></script>

    @yield('scripts')

</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestión Veterinaria">
    <meta name="author" content="">

    <title>@yield('titulo_pagina', 'Login') - Veterinaria</title>

    <!-- Fontawesome -->
    <link href="{{ asset('startbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- SB Admin 2 CSS (para mantener compatibilidad con otros elementos) -->
    <link href="{{ asset('startbootstrap/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        /* Reset para que el body ocupe toda la pantalla sin márgenes del template */
        html, body {
            height: 100%;
            margin: 0 !important;
            padding: 0 !important;
            overflow-x: hidden;
        }
        body {
            background: transparent !important;
        }
    </style>

    @yield('estilos')
</head>

<body>

    @yield('contenido')

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

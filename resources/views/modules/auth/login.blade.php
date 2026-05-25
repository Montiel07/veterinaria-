@extends('layouts.auth')

@section('titulo_pagina', 'Iniciar Sesión')

@section('estilos')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
        height: 100%;
        font-family: 'Inter', sans-serif !important;
        background: #f0f4ff !important;
    }

    /* ── Layout principal ── */
    .login-wrapper {
        display: flex;
        min-height: 100vh;
        width: 100%;
    }

    /* ── Panel izquierdo — decorativo ── */
    .login-left {
        flex: 1;
        background: linear-gradient(145deg, #1a3de4 0%, #3065e7 45%, #4f8ef7 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 2.5rem;
        position: relative;
        overflow: hidden;
    }

    /* Círculos decorativos de fondo */
    .login-left::before {
        content: '';
        position: absolute;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
        top: -100px;
        left: -100px;
    }
    .login-left::after {
        content: '';
        position: absolute;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        bottom: -80px;
        right: -80px;
    }

    .login-left-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .login-logo {
        width: 100%;
        max-width: none;
        height: auto;
        object-fit: contain;
        background: none;
        filter: drop-shadow(0 20px 40px rgba(0,0,0,0.25));
        margin-bottom: 2rem;
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50%       { transform: translateY(-12px); }
    }

    .login-brand-name {
        font-size: 1.75rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.03rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .login-brand-tagline {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.75);
        font-weight: 400;
        letter-spacing: 0.02rem;
    }

    /* Puntos decorativos */
    .dots-grid {
        position: absolute;
        bottom: 40px;
        left: 40px;
        opacity: 0.15;
        display: grid;
        grid-template-columns: repeat(6, 10px);
        gap: 10px;
    }
    .dots-grid span {
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #fff;
        display: block;
    }

    /* ── Panel derecho — formulario ── */
    .login-right {
        width: 600px;
        min-width: 600px;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 4.5rem;
        box-shadow: -20px 0 60px rgba(26,61,228,0.08);
    }

    .login-form-container {
        width: 100%;
        max-width: 480px;
    }

    .login-welcome {
        margin-bottom: 2.5rem;
    }

    .login-welcome-sup {
        font-size: 0.8rem;
        font-weight: 600;
        color: #3065e7;
        letter-spacing: 0.1rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .login-welcome-sup::before {
        content: '';
        display: inline-block;
        width: 24px;
        height: 2px;
        background: #3065e7;
        border-radius: 2px;
    }

    .login-welcome h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.04rem;
        line-height: 1.2;
        margin-bottom: 0.6rem;
    }

    .login-welcome p {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 400;
    }

    /* ── Campos del formulario ── */
    .form-field {
        margin-bottom: 1.25rem;
    }

    .form-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.875rem;
        pointer-events: none;
        transition: color 0.2s;
    }

    .input-wrapper input {
        width: 100%;
        height: 56px;
        padding: 0 1rem 0 2.75rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        color: #0f172a;
        background: #f8fafc;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
        outline: none;
    }

    .input-wrapper input:focus {
        border-color: #3065e7;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(48,101,231,0.1);
    }

    .input-wrapper input:focus + i,
    .input-wrapper input:focus ~ i {
        color: #3065e7;
    }

    .input-wrapper input.is-invalid {
        border-color: #ef4444;
        background: #fff5f5;
    }

    /* Icono a la derecha del password */
    .input-wrapper .icon-left { left: 1rem; }
    .input-wrapper .icon-right {
        left: auto;
        right: 1rem;
        cursor: pointer;
        pointer-events: all;
        color: #94a3b8;
    }
    .input-wrapper .icon-right:hover { color: #3065e7; }

    /* Padding cuando hay icono derecho */
    .input-has-right { padding-right: 2.75rem !important; }

    /* ── Alerta errores ── */
    .login-alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-left: 4px solid #ef4444;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
        color: #991b1b;
    }
    .login-alert ul { padding-left: 1.2rem; margin: 0; }

    /* ── Botón ── */
    .btn-login {
        width: 100%;
        height: 58px;
        background: linear-gradient(135deg, #3065e7 0%, #4f8ef7 100%);
        border: none;
        border-radius: 10px;
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        letter-spacing: 0.01rem;
        margin-top: 0.5rem;
        box-shadow: 0 4px 15px rgba(48,101,231,0.35);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(48,101,231,0.45);
    }

    .btn-login:active {
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(48,101,231,0.3);
    }

    /* ── Footer ── */
    .login-footer {
        margin-top: 2rem;
        text-align: center;
        font-size: 0.78rem;
        color: #94a3b8;
    }

    /* ── Responsive ── */
    @media (max-width: 900px) {
        .login-left { display: none; }
        .login-right {
            width: 100%;
            min-width: unset;
            padding: 2rem 1.5rem;
        }
    }
</style>
@endsection

@section('contenido')
<div class="login-wrapper">

    {{-- ════════════════════════════════════
         PANEL IZQUIERDO — DECORATIVO
    ════════════════════════════════════ --}}
    <div class="login-left">
        <div class="login-left-content">
            <img src="{{ asset('img/logo_veterinaria.png') }}" alt="Logo Veterinaria Santa María" class="login-logo">
            <p class="login-brand-name">Veterinaria Santa María</p>
            <p class="login-brand-tagline">Cuidamos a tus mejores amigos con amor</p>
        </div>

        {{-- Puntos decorativos --}}
        <div class="dots-grid">
            @for ($i = 0; $i < 30; $i++)
                <span></span>
            @endfor
        </div>
    </div>

    {{-- ════════════════════════════════════
         PANEL DERECHO — FORMULARIO
    ════════════════════════════════════ --}}
    <div class="login-right">
        <div class="login-form-container">

            {{-- Encabezado --}}
            <div class="login-welcome">
                <p class="login-welcome-sup">Sistema de Gestión</p>
                <h1>Iniciar Sesión</h1>
                <p>Ingresa tus credenciales para acceder al sistema.</p>
            </div>

            {{-- Errores --}}
            @if ($errors->any())
                <div class="login-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('logear') }}" method="POST" autocomplete="off">
                @csrf

                {{-- Correo --}}
                <div class="form-field">
                    <label for="email">Correo electrónico</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope icon-left"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="correo@ejemplo.com"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            required
                            autofocus>
                    </div>
                </div>

                {{-- Contraseña --}}
                <div class="form-field">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock icon-left"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            class="input-has-right {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            required>
                        <i class="fas fa-eye icon-right" id="togglePassword" title="Mostrar contraseña"></i>
                    </div>
                </div>

                {{-- Botón --}}
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </button>
            </form>

            {{-- Footer --}}
            <div class="login-footer">
                © {{ date('Y') }} Veterinaria Santa María · Todos los derechos reservados
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Toggle mostrar/ocultar contraseña
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        this.classList.toggle('fa-eye', !isPassword);
        this.classList.toggle('fa-eye-slash', isPassword);
    });
</script>
@endsection

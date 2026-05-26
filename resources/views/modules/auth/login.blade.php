@extends('layouts/main')

@section('titulo_pagina', 'Login de usuario')

@section('contenido')
<div style="display: flex; flex-direction: row; flex-wrap: wrap; align-items: center; justify-content: center; width: 100%; max-width: 1100px; gap: 40px; padding: 20px;">
    
    <!-- Lado Izquierdo: Imagen y Descripción -->
    <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; align-items: center; text-align: center; padding: 20px;">
        <img src="{{ asset('img/login-banner.jpg') }}" alt="VetSystem Banner" style="width: 100%; max-width: 500px; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); border: 2px solid rgba(255,255,255,0.1);">
        <div style="margin-top: 1.5rem; background: rgba(15, 23, 42, 0.4); padding: 1.5rem; border-radius: 16px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
            <h3 style="color: white; margin-top: 0; margin-bottom: 0.5rem; font-weight: 700;">Plataforma Veterinaria Integral</h3>
            <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.6; margin: 0;">
                Gestiona pacientes, citas, inventarios y carnets de vacunación en un solo lugar. Todo lo que necesitas para el cuidado de las mascotas con la mejor tecnología.
            </p>
        </div>
    </div>

    <!-- Lado Derecho: Formulario -->
    <div class="glass-container" style="flex: 1; min-width: 300px; margin: 0;">
        <h2 class="glass-title">Bienvenido a VetSystem</h2>
        <form action="{{ route('logear') }}" method="post">
            @csrf
            @method('post')
            <div class="custom-form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="custom-form-control" name="email" id="email" placeholder="Ingresa tu correo" required>
            </div>
            <div class="custom-form-group">
                <label for="password">Contraseña</label>
                <div style="position: relative; width: 100%;">
                    <input type="password" name="password" id="password" class="custom-form-control" placeholder="Ingresa tu contraseña" required style="padding-right: 40px; box-sizing: border-box; width: 100%;">
                    <button type="button" onclick="togglePassword('password', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94a3b8; cursor: pointer; font-size: 1.2rem;">
                        👁️
                    </button>
                </div>
            </div>
            <button type="submit" class="btn-glass-primary">Entrar</button>
            <a href="{{ route('registro') }}" class="btn-glass-secondary">¿No tienes cuenta? Regístrate aquí</a>
        </form>
    </div>
</div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerText = '🙈';
            } else {
                input.type = 'password';
                btn.innerText = '👁️';
            }
        }
    </script>
@endsection

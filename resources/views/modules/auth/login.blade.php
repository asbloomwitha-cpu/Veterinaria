@extends('layouts/main')

@section('titulo_pagina', 'Login de usuario')

@section('contenido')
    <div class="glass-container">
        <h2 class="glass-title">Bienvenido de nuevo</h2>
        <form action="{{ route('logear') }}" method="post">
            @csrf
            @method('post')
            <div class="custom-form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="custom-form-control" name="email" id="email" placeholder="Ingresa tu correo" required>
            </div>
            <div class="custom-form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="custom-form-control" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit" class="btn-glass-primary">Entrar</button>
            <a href="{{ route('registro') }}" class="btn-glass-secondary">¿No tienes cuenta? Regístrate aquí</a>
            
            <!-- Botones de Demostración -->
            <div style="margin-top: 1.5rem; border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
                <p style="text-align: center; font-size: 0.85rem; color: #94a3b8; margin-bottom: 1rem;">Accesos de Demostración</p>
                <div style="display: flex; gap: 0.5rem; justify-content: space-between;">
                    <button type="button" class="btn-glass-sm btn-glass-info" onclick="fillDemo('vet@demo.com', 'password')" style="flex: 1; text-align: center;">👨‍⚕️ Veterinario</button>
                    <button type="button" class="btn-glass-sm btn-glass-danger" onclick="fillDemo('admin@demo.com', 'password')" style="flex: 1; text-align: center;">👑 Admin</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function fillDemo(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
@endsection
@extends('layouts/main')
@section('titulo_pagina', 'Registro de usuario')
    
@section('contenido')
<div class="glass-container">
    <h2 class="glass-title">Crear nueva cuenta</h2>
    <form action="{{ route('registrar') }}" method="post">
        @csrf
        @method('POST')
        <div class="custom-form-group">
            <label for="name">Nombre Completo</label>
            <input type="text" name="name" id="name" class="custom-form-control" placeholder="Ingresa tu nombre" required>
        </div>
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
        <div class="custom-form-group">
            <label for="rol">Tipo de Cuenta</label>
            <select name="rol" id="rol" class="custom-form-control" required onchange="toggleClaveEspecial()" style="appearance: none; cursor: pointer; background-image: url('data:image/svg+xml;utf8,<svg fill=\'%23cbd5e1\' height=\'24\' viewBox=\'0 0 24 24\' width=\'24\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/><path d=\'M0 0h24v24H0z\' fill=\'none\'/></svg>'); background-repeat: no-repeat; background-position-x: 95%; background-position-y: 50%;">
                <option value="usuario" style="color: #0f172a;" selected>👤 Cliente / Dueño de Mascota</option>
                <option value="veterinario" style="color: #0f172a;">👨‍⚕️ Veterinario</option>
                <option value="administrador" style="color: #0f172a;">👑 Administrador</option>
            </select>
        </div>
        <div class="custom-form-group" id="div_clave_especial" style="display: none;">
            <label for="clave_especial">Clave de Autorización</label>
            <input type="password" name="clave_especial" id="clave_especial" class="custom-form-control" placeholder="Requerida para Veterinario/Administrador">
            @error('clave_especial')
                <small style="color: #ef4444; margin-top: 5px; display: block;">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn-glass-primary">Registrarse</button>
        <a href="{{ route('login') }}" class="btn-glass-secondary">¿Ya tienes cuenta? Inicia sesión</a>
    </form>
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

    function toggleClaveEspecial() {
        const rol = document.getElementById('rol').value;
        const divClave = document.getElementById('div_clave_especial');
        const inputClave = document.getElementById('clave_especial');
        
        if (rol === 'veterinario' || rol === 'administrador') {
            divClave.style.display = 'block';
            inputClave.required = true;
        } else {
            divClave.style.display = 'none';
            inputClave.required = false;
        }
    }

    // Ejecutar al inicio por si hay errores de validación previos
    document.addEventListener('DOMContentLoaded', toggleClaveEspecial);
</script>
@endsection

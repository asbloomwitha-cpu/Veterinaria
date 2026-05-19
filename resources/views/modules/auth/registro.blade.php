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
            <input type="password" name="password" id="password" class="custom-form-control" placeholder="Ingresa tu contraseña" required>
        </div>
        <div class="custom-form-group">
            <label for="rol">Tipo de Cuenta</label>
            <select name="rol" id="rol" class="custom-form-control" required style="appearance: none; cursor: pointer; background-image: url('data:image/svg+xml;utf8,<svg fill=\'%23cbd5e1\' height=\'24\' viewBox=\'0 0 24 24\' width=\'24\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\'/><path d=\'M0 0h24v24H0z\' fill=\'none\'/></svg>'); background-repeat: no-repeat; background-position-x: 95%; background-position-y: 50%;">
                <option value="veterinario" style="color: #0f172a;">👨‍⚕️ Veterinario</option>
                <option value="administrador" style="color: #0f172a;">👑 Administrador</option>
            </select>
        </div>
        <button type="submit" class="btn-glass-primary">Registrarse</button>
        <a href="{{ route('login') }}" class="btn-glass-secondary">¿Ya tienes cuenta? Inicia sesión</a>
    </form>
</div>
@endsection
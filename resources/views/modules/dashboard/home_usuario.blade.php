@extends('layouts.dashboard')

@section('titulo_pagina', 'Mi Dashboard')

@section('contenido')
<style>
.stat-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    color: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    background: rgba(255, 255, 255, 0.15);
}
.stat-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.8;
}
.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
.stat-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #e2e8f0;
    text-transform: uppercase;
    letter-spacing: 1px;
}
</style>

<div style="margin-bottom: 3rem;">
    <h2 style="margin: 0; color: white; font-weight: 800; font-size: 2rem;">Hola, {{ auth()->user()->name }}</h2>
    <p style="color: #cbd5e1; margin: 0; font-size: 1.1rem;">Bienvenido a tu panel personal de VetSystem.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
    <!-- Tarjeta 1: Mascotas -->
    <a href="{{ route('pacientes.index') }}" style="text-decoration: none;">
        <div class="stat-card" style="border-top: 4px solid #38bdf8;">
            <div class="stat-icon">🐾</div>
            <div class="stat-value">{{ $stats['totalPacientes'] }}</div>
            <div class="stat-label">Mis Mascotas</div>
        </div>
    </a>

    <!-- Tarjeta 2: Próximas Citas -->
    <a href="{{ route('citas.index') }}" style="text-decoration: none;">
        <div class="stat-card" style="border-top: 4px solid #a855f7;">
            <div class="stat-icon">📅</div>
            <div class="stat-value">{{ $stats['proximasCitas'] }}</div>
            <div class="stat-label">Próximas Citas</div>
        </div>
    </a>

    <!-- Tarjeta 3: Vacunas -->
    <div class="stat-card" style="border-top: 4px solid #10b981;">
        <div class="stat-icon">💉</div>
        <div class="stat-value">{{ $stats['vacunasPendientes'] }}</div>
        <div class="stat-label">Vacunas Pendientes</div>
    </div>
</div>

<div class="glass-form-container" style="text-align: center; max-width: 800px; margin: 0 auto; padding: 3rem; background: rgba(255,255,255,0.05); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
    <h3 style="color: white; margin-bottom: 1rem;">Cuidando a tus mejores amigos</h3>
    <p style="color: #cbd5e1; font-size: 1.1rem; line-height: 1.6;">
        Usa el menú lateral para gestionar el perfil de tus mascotas y programar nuevas citas. Nosotros nos encargamos del resto.
    </p>
    <a href="{{ route('citas.create') }}" class="btn-glass-primary" style="display: inline-block; width: auto; padding: 0.8rem 2rem; margin-top: 1rem; text-decoration: none;">Agendar una Cita</a>
</div>
@endsection

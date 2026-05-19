@extends('layouts.dashboard')

@section('titulo_pagina', 'Panel Principal')

@section('contenido')
    @if(auth()->user()->rol === 'administrador')
        <div class="glass-alert" style="background: rgba(99, 102, 241, 0.2); color: #a5b4fc; border-color: rgba(99, 102, 241, 0.3);">
            <strong>Modo Administrador:</strong> Tienes acceso a todas las estadísticas globales y configuraciones del sistema.
        </div>

        <!-- Statistics Cards for Admin -->
        <div class="stats-grid">
            <div class="glass-stat-card">
                <div class="stat-title">Total Usuarios</div>
                <div class="stat-value">{{ \App\Models\User::count() ?? 0 }}</div>
            </div>
            <div class="glass-stat-card">
                <div class="stat-title">Total Pacientes</div>
                <div class="stat-value">{{ \App\Models\Paciente::count() ?? 0 }}</div>
            </div>
            <div class="glass-stat-card">
                <div class="stat-title">Citas Registradas</div>
                <div class="stat-value">{{ \App\Models\Cita::count() ?? 0 }}</div>
            </div>
        </div>

        <!-- Main Section -->
        <div class="glass-table-container">
            <h2 style="margin-top: 0; color: white;">Panel de Administración (Vista Global)</h2>
            <p style="color: #cbd5e1; line-height: 1.6;">
                Desde aquí puedes gestionar el acceso de los veterinarios y supervisar el volumen general de la clínica.
                Utiliza el menú lateral para administrar los diferentes módulos del sistema.
            </p>
            <div style="margin-top: 1rem;">
                <a href="{{ route('usuarios.index') }}" class="btn-glass-primary" style="width: auto; padding: 0.5rem 1.5rem; display: inline-block;">Gestión de Usuarios</a>
            </div>
        </div>

    @else
        <div class="glass-alert" style="background: rgba(56, 189, 248, 0.2); color: #7dd3fc; border-color: rgba(56, 189, 248, 0.3);">
            <strong>Modo Veterinario:</strong> Estás viendo tu panel de atención clínica y gestión diaria.
        </div>

        <!-- Statistics Cards for Veterinarian -->
        <div class="stats-grid">
            <div class="glass-stat-card">
                <div class="stat-title">Mis Pacientes</div>
                <div class="stat-value">{{ \App\Models\Paciente::count() ?? 0 }}</div>
            </div>
            <div class="glass-stat-card">
                <div class="stat-title">Citas Hoy</div>
                <div class="stat-value">{{ \App\Models\Cita::whereDate('fecha_hora', today())->count() ?? 0 }}</div>
            </div>
            <div class="glass-stat-card">
                <div class="stat-title">Historiales Médicos</div>
                <div class="stat-value">{{ \App\Models\HistorialMedico::count() ?? 0 }}</div>
            </div>
        </div>

        <!-- Main Section -->
        <div class="glass-table-container">
            <h2 style="margin-top: 0; color: white;">Atención Veterinaria</h2>
            <p style="color: #cbd5e1; line-height: 1.6;">
                Revisa tus citas programadas para hoy y administra el historial médico de tus pacientes directamente desde el menú lateral.
            </p>
            <div style="margin-top: 1rem;">
                <a href="{{ route('pacientes.index') }}" class="btn-glass-primary" style="width: auto; padding: 0.5rem 1.5rem; display: inline-block;">Ver Mis Pacientes</a>
            </div>
        </div>
    @endif
@endsection
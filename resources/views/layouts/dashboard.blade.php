<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo_pagina') - VetSystem</title>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="glass-sidebar">
            <div class="sidebar-logo">
                🐾 VetSystem
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">📊 Dashboard</a></li>
                <li><a href="{{ route('pacientes.index') }}" class="{{ request()->routeIs('pacientes.*') ? 'active' : '' }}">🐶 Pacientes</a></li>
                <li><a href="{{ route('citas.index') }}" class="{{ request()->routeIs('citas.*') ? 'active' : '' }}">📅 Citas</a></li>
                <li><a href="{{ route('historial.index') }}" class="{{ request()->routeIs('historial.*') ? 'active' : '' }}">🏥 Historial Médico</a></li>
                <li><a href="{{ route('usuarios.index') }}" class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">👥 Usuarios</a></li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="dashboard-content">
            <!-- Topbar -->
            <header class="glass-topbar">
                <div class="topbar-welcome">
                    Hola, <strong>{{ auth()->user()->name ?? 'Veterinario' }}</strong>
                </div>
                <div class="topbar-actions">
                    <a href="{{ route('logout') }}" class="btn-glass-danger btn-glass-sm">Cerrar Sesión</a>
                </div>
            </header>

            <!-- Page Content -->
            @yield('contenido')
        </main>
    </div>

</body>
</html>

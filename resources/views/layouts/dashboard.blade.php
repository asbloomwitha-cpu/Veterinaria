<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo_pagina') - VetSystem</title>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                
                @if(auth()->user()->rol === 'administrador' || auth()->user()->rol === 'veterinario')
                    <li><a href="{{ route('pacientes.index') }}" class="{{ request()->routeIs('pacientes.*') ? 'active' : '' }}">🐶 Pacientes</a></li>
                    <li><a href="{{ route('vacunas.index') }}" class="{{ request()->routeIs('vacunas.*') ? 'active' : '' }}">💉 Vacunas</a></li>
                    <li><a href="{{ route('citas.index') }}" class="{{ request()->routeIs('citas.*') ? 'active' : '' }}">📅 Citas</a></li>
                    <li><a href="{{ route('historial.index') }}" class="{{ request()->routeIs('historial.*') ? 'active' : '' }}">🏥 Historial Médico</a></li>
                @endif
                
                @if(auth()->user()->rol === 'usuario')
                    <li><a href="{{ route('pacientes.index') }}" class="{{ request()->routeIs('pacientes.*') ? 'active' : '' }}">🐾 Mis Mascotas</a></li>
                    <li><a href="{{ route('citas.index') }}" class="{{ request()->routeIs('citas.*') ? 'active' : '' }}">📅 Mis Citas</a></li>
                @endif

                @if(auth()->user()->rol === 'administrador')
                    <li><a href="{{ route('productos.index') }}" class="{{ request()->routeIs('productos.*') ? 'active' : '' }}">📦 Inventario</a></li>
                    <li><a href="{{ route('usuarios.index') }}" class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">👥 Usuarios</a></li>
                @endif
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="dashboard-content">
            <!-- Topbar -->
            <header class="glass-topbar">
                <div class="topbar-welcome">
                    Hola, <strong>{{ auth()->user()->name ?? 'Veterinario' }}</strong>
                    <span style="font-size: 0.85em; opacity: 0.8; margin-left: 8px;">({{ ucfirst(auth()->user()->rol ?? 'Invitado') }})</span>
                </div>
                <div class="topbar-actions">
                    <a href="{{ route('logout') }}" class="btn-glass-danger btn-glass-sm">Cerrar Sesión</a>
                </div>
            </header>

            <!-- Page Content -->
            @yield('contenido')
        </main>
    </div>

    <!-- SweetAlert2 CDN & Configuración Global -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .glass-toast {
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            background: rgba(255, 255, 255, 0.8) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1) !important;
            color: #333 !important;
        }
        @media (prefers-color-scheme: dark) {
            .glass-toast {
                background: rgba(30, 30, 30, 0.8) !important;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                color: #fff !important;
            }
        }
    </style>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'glass-toast'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
        @endif
        @if(session('error'))
            Toast.fire({ icon: 'error', title: '{{ session('error') }}' });
        @endif
        @if(session('warning'))
            Toast.fire({ icon: 'warning', title: '{{ session('warning') }}' });
        @endif
        @if(session('info'))
            Toast.fire({ icon: 'info', title: '{{ session('info') }}' });
        @endif
        @if($errors->any())
            Toast.fire({ icon: 'error', title: 'Por favor, revisa que los datos ingresados sean correctos.' });
        @endif

        // Confirmaciones globales de eliminación
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.form-delete');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); 
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede deshacer.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e74a3b',
                        cancelButtonColor: '#858796',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        background: 'rgba(255, 255, 255, 0.95)',
                        backdrop: `rgba(0,0,0,0.4)`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>

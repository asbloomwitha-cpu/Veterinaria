@extends('layouts.dashboard')

@section('titulo_pagina', 'Agenda de Citas')

@section('contenido')
<style>
.vet-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 1.8rem;
    color: white;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
.table-clean th { border-top: none; color: #cbd5e1; font-weight: 600; font-size: 0.85rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
.table-clean td { vertical-align: middle; border-top: 1px solid rgba(255,255,255,0.1); padding: 1rem 0.5rem; color: #f8fafc; font-weight: 600; font-size: 0.9rem; }
.btn-vetsystem { background-color: #6366f1; color: white; border-radius: 12px; font-weight: 600; padding: 0.6rem 1.5rem; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4); text-decoration: none; display: inline-block;}
.btn-vetsystem:hover { background-color: #4f46e5; color: white; transform: translateY(-2px); text-decoration: none;}
.btn-action { color: #94a3b8; background: transparent; border: none; margin-right: 5px; transition: color 0.2s;}
.btn-action.edit:hover { color: #60a5fa; }
.btn-action.delete:hover { color: #f87171; }
.badge-soft-success { background-color: rgba(16, 185, 129, 0.2); color: #34d399; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; border: 1px solid rgba(16, 185, 129, 0.3);}
.badge-soft-warning { background-color: rgba(245, 158, 11, 0.2); color: #fbbf24; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; border: 1px solid rgba(245, 158, 11, 0.3);}
.badge-soft-danger { background-color: rgba(239, 68, 68, 0.2); color: #f87171; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; border: 1px solid rgba(239, 68, 68, 0.3);}
.badge-soft-purple { background-color: rgba(139, 92, 246, 0.2); color: #a78bfa; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem; border: 1px solid rgba(139, 92, 246, 0.3);}


/* FullCalendar Premium Customizations */
.fc { color: white !important; font-family: 'Inter', sans-serif; }
.fc * { color: white !important; border-color: rgba(255,255,255,0.08) !important; }
.fc-theme-standard td, .fc-theme-standard th { border-color: rgba(255,255,255,0.08) !important; }
.fc-toolbar-title { font-size: 1.5rem !important; font-weight: 800 !important; color: white !important; text-transform: capitalize; letter-spacing: 0.5px; }
.fc-col-header-cell-cushion { color: #cbd5e1 !important; text-decoration: none; padding: 12px !important; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; }
.fc-daygrid-day-number { color: white !important; text-decoration: none; font-weight: 600; padding: 10px !important; font-size: 1rem; }
.fc-daygrid-day-number:hover { background: rgba(99, 102, 241, 0.2); border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; margin: 5px; color: white !important; }
.fc-button-primary { background: linear-gradient(135deg, #6366f1, #4f46e5) !important; border: none !important; border-radius: 10px !important; color: white !important; text-transform: capitalize; font-weight: 600 !important; padding: 0.6rem 1.2rem !important; box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3) !important; transition: all 0.3s ease !important; }
.fc-button-primary:hover, .fc-button-primary:not(:disabled).fc-button-active { background: linear-gradient(135deg, #4f46e5, #4338ca) !important; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4) !important; color: white !important; }
.fc-daygrid-event { cursor: pointer; border-radius: 8px; padding: 4px 8px; border: none !important; font-size: 0.85rem; font-weight: 600; margin-bottom: 4px; transition: transform 0.2s ease, box-shadow 0.2s ease; }
.fc-daygrid-event:hover { transform: scale(1.02); box-shadow: 0 4px 8px rgba(0,0,0,0.2); z-index: 5; }
.fc-event-title { color: white !important; font-weight: 700; }
.fc-event-time { color: rgba(255,255,255,0.9) !important; font-weight: 500; }
.event-pendiente { background: linear-gradient(135deg, #f59e0b, #d97706) !important; }
.event-en_proceso { background: linear-gradient(135deg, #8b5cf6, #7c3aed) !important; }
.event-completada { background: linear-gradient(135deg, #10b981, #059669) !important; }
.event-cancelada { background: linear-gradient(135deg, #ef4444, #dc2626) !important; }
.fc-day-today { background-color: rgba(99, 102, 241, 0.15) !important; border-radius: 8px; }
.fc-view-harness { padding-top: 15px; }
.fc-scrollgrid { border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.08) !important; }
</style>

<!-- FullCalendar CSS and JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

<div class="row mb-4 align-items-center" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 300px;">
        <h2 style="font-weight: 800; color: white; margin-bottom: 0;">Agenda de Citas</h2>
        <p style="color: #cbd5e1; font-size: 1.05rem; margin-bottom: 0; font-weight: 500;">Gestión de consultas y servicios médicos.</p>
    </div>
    <div style="text-align: right; margin-top: 10px;">
        <a href="{{ route('citas.create') }}" class="btn btn-vetsystem">
            <i class="fas fa-calendar-plus mr-2"></i> Agendar Nueva Cita
        </a>
    </div>
</div>

@if(session('success'))
<div style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; font-weight: 600;">
    {{ session('success') }}
</div>
@endif

<!-- Calendario -->
<div class="vet-card mb-4" style="margin-bottom: 2rem;">
    <div id="calendar"></div>
</div>

<h4 style="font-weight: 800; color: white; margin-bottom: 1rem;">Listado Detallado de Citas</h4>
<div class="vet-card" data-aos="fade-up">
    <div class="table-responsive">
        <table class="table table-clean">
            <thead>
                <tr>
                    <th>Fecha y Hora</th>
                    <th>Mascota</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>
                        <div class="font-weight-bold">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y') }}</div>
                        <div class="small text-muted">{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('h:i A') }}</div>
                    </td>
                    <td><strong>{{ $cita->paciente->nombre }}</strong></td>
                    <td style="color: #cbd5e1;">{{ $cita->motivo }}</td>
                    <td>
                        @switch($cita->estado)
                            @case('pendiente')
                                <span class="badge-soft-warning">Pendiente</span>
                                @break
                            @case('en_proceso')
                                <span class="badge-soft-purple">En Proceso</span>
                                @break
                            @case('completada')
                                <span class="badge-soft-success">Completada</span>
                                @break
                            @case('cancelada')
                                <span class="badge-soft-danger">Cancelada</span>
                                @break
                        @endswitch
                    </td>
                    <td class="text-right">
                        <a href="{{ route('citas.edit', $cita->id) }}" class="btn-action edit" title="Editar / Actualizar Estado">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="d-inline form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4" style="color: #94a3b8; text-align: center;">No hay citas agendadas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            contentHeight: 'auto',
            events: [
                @foreach($citas as $cita)
                {
                    title: '{{ $cita->paciente->nombre }} - {{ $cita->motivo }}',
                    start: '{{ \Carbon\Carbon::parse($cita->fecha_hora)->toIso8601String() }}',
                    url: '{{ route('citas.edit', $cita->id) }}',
                    className: 'event-{{ $cita->estado }}'
                },
                @endforeach
            ]
        });
        calendar.render();
    });
</script>
@endsection

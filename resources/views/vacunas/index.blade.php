@extends('layouts.dashboard')

@section('titulo_pagina', 'Carnet de Vacunación')

@section('contenido')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="margin: 0; color: white;">💉 Carnet de Vacunación</h2>
        <p style="color: #cbd5e1; margin: 0;">Registro de vacunas y desparasitaciones de pacientes.</p>
    </div>
    <a href="{{ route('vacunas.create') }}" class="btn-glass-primary" style="width: auto; padding: 0.5rem 1.5rem;">
        + Registrar Vacuna
    </a>
</div>

@if(session('success'))
<div class="glass-alert">
    {{ session('success') }}
</div>
@endif

<div class="glass-table-container">
    <table class="glass-table">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Vacuna / Desparasitante</th>
                <th>Fecha de Aplicación</th>
                <th>Próxima Dosis</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vacunas as $vacuna)
            <tr>
                <td><strong>{{ $vacuna->paciente->nombre }}</strong></td>
                <td>{{ $vacuna->nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($vacuna->fecha_aplicacion)->format('d/m/Y') }}</td>
                <td>
                    @if($vacuna->proxima_dosis)
                        @php
                            $diasParaVencer = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($vacuna->proxima_dosis), false);
                        @endphp
                        
                        @if($diasParaVencer <= 0)
                            <span style="color: #fca5a5; font-weight: bold;">Vencida ({{ \Carbon\Carbon::parse($vacuna->proxima_dosis)->format('d/m/Y') }})</span>
                        @elseif($diasParaVencer <= 15)
                            <span style="color: #fcd34d; font-weight: bold;">Pronto ({{ \Carbon\Carbon::parse($vacuna->proxima_dosis)->format('d/m/Y') }})</span>
                        @else
                            {{ \Carbon\Carbon::parse($vacuna->proxima_dosis)->format('d/m/Y') }}
                        @endif
                    @else
                        No requiere
                    @endif
                </td>
                <td>
                    <a href="{{ route('vacunas.edit', $vacuna->id) }}" class="btn-glass-sm btn-glass-info">Editar</a>
                    <form action="{{ route('vacunas.destroy', $vacuna->id) }}" method="POST" style="display: inline-block;" class="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-glass-sm btn-glass-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #94a3b8;">No hay vacunas registradas aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

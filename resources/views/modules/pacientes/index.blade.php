@extends('layouts.dashboard')

@section('titulo_pagina', 'Pacientes')

@section('contenido')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="margin: 0; color: white;">Pacientes</h2>
        <p style="color: #cbd5e1; margin: 0;">Listado de mascotas registradas en la clínica.</p>
    </div>
    <a href="{{ route('pacientes.create') }}" class="btn-glass-primary" style="width: auto; padding: 0.5rem 1.5rem;">
        + Registrar Paciente
    </a>
</div>

<div style="margin-bottom: 1.5rem; background: var(--glass-bg); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
    <form action="{{ route('pacientes.index') }}" method="GET" style="display: flex; gap: 1rem; align-items: center;">
        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre, especie, propietario..." class="custom-form-control" style="flex: 1; margin: 0;">
        <button type="submit" class="btn-glass-primary" style="width: auto; margin: 0; padding: 0.75rem 1.5rem;">Buscar</button>
        @if(request('buscar'))
            <a href="{{ route('pacientes.index') }}" class="btn-glass-secondary" style="width: auto; margin: 0; padding: 0.75rem 1.5rem; border-color: rgba(239, 68, 68, 0.3); color: #fca5a5; background: rgba(239, 68, 68, 0.1);">Limpiar</a>
        @endif
    </form>
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
                <th>Mascota</th>
                <th>Especie / Raza</th>
                <th>Edad</th>
                <th>Propietario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pacientes as $paciente)
            <tr>
                <td style="display: flex; align-items: center; gap: 10px;">
                    @if($paciente->foto)
                        <img src="{{ asset('storage/' . $paciente->foto) }}" alt="Foto" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                    @else
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #64748b;">
                            {{ substr($paciente->nombre, 0, 1) }}
                        </div>
                    @endif
                    <strong>{{ $paciente->nombre }}</strong>
                </td>
                <td>{{ $paciente->especie }} / {{ $paciente->raza ?? 'N/A' }}</td>
                <td>{{ $paciente->edad ? $paciente->edad . ' años' : 'N/A' }}</td>
                <td>
                    <div>{{ $paciente->user ? $paciente->user->name : $paciente->nombre_propietario }}</div>
                    <div style="font-size: 0.8rem; color: #94a3b8;">{{ $paciente->user ? $paciente->user->email : $paciente->telefono_propietario }}</div>
                </td>
                <td>
                    <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn-glass-sm btn-glass-info">Editar</a>
                    <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display: inline-block;" class="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-glass-sm btn-glass-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #94a3b8;">No hay pacientes registrados aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

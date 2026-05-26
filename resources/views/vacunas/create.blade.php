@extends('layouts.dashboard')

@section('titulo_pagina', 'Registrar Vacuna')

@section('contenido')
<div style="margin-bottom: 2rem;">
    <h2 style="margin: 0; color: white;">💉 Registrar Vacuna o Desparasitante</h2>
</div>

<div class="glass-form-container" style="max-width: 600px;">
    <form action="{{ route('vacunas.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Paciente</label>
            <select name="paciente_id" class="custom-form-control" required>
                <option value="">-- Seleccionar Paciente --</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} ({{ $paciente->especie }})
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Nombre de la Vacuna / Producto</label>
            <input type="text" name="nombre" class="custom-form-control" required value="{{ old('nombre') }}" placeholder="Ej: Rabia, Séxtuple, Bravecto...">
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <div style="flex: 1;">
                <label style="color: white; display: block; margin-bottom: 0.5rem;">Fecha de Aplicación</label>
                <input type="date" name="fecha_aplicacion" class="custom-form-control" required value="{{ old('fecha_aplicacion', date('Y-m-d')) }}">
            </div>
            <div style="flex: 1;">
                <label style="color: white; display: block; margin-bottom: 0.5rem;">Próxima Dosis (Opcional)</label>
                <input type="date" name="proxima_dosis" class="custom-form-control" value="{{ old('proxima_dosis') }}">
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Observaciones</label>
            <textarea name="observaciones" class="custom-form-control" rows="3">{{ old('observaciones') }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn-glass-primary">Guardar Registro</button>
            <a href="{{ route('vacunas.index') }}" class="btn-glass-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.dashboard')

@section('titulo_pagina', 'Nuevo Producto')

@section('contenido')
<div style="margin-bottom: 2rem;">
    <h2 style="margin: 0; color: white;">📦 Registrar Nuevo Producto</h2>
</div>

<div class="glass-form-container" style="max-width: 600px;">
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Nombre</label>
            <input type="text" name="nombre" class="custom-form-control" required value="{{ old('nombre') }}">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Categoría</label>
            <select name="categoria" class="custom-form-control" required>
                <option value="Medicamento">Medicamento</option>
                <option value="Alimento">Alimento</option>
                <option value="Accesorio">Accesorio</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <div style="flex: 1;">
                <label style="color: white; display: block; margin-bottom: 0.5rem;">Precio ($)</label>
                <input type="number" step="0.01" name="precio" class="custom-form-control" required value="{{ old('precio') }}">
            </div>
            <div style="flex: 1;">
                <label style="color: white; display: block; margin-bottom: 0.5rem;">Stock Inicial</label>
                <input type="number" name="stock" class="custom-form-control" required value="{{ old('stock') }}">
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Descripción (Opcional)</label>
            <textarea name="descripcion" class="custom-form-control" rows="3">{{ old('descripcion') }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn-glass-primary">Guardar Producto</button>
            <a href="{{ route('productos.index') }}" class="btn-glass-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

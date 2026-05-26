@extends('layouts.dashboard')

@section('titulo_pagina', 'Editar Producto')

@section('contenido')
<div style="margin-bottom: 2rem;">
    <h2 style="margin: 0; color: white;">📦 Editar Producto</h2>
</div>

<div class="glass-form-container" style="max-width: 600px;">
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Nombre</label>
            <input type="text" name="nombre" class="custom-form-control" required value="{{ old('nombre', $producto->nombre) }}">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Categoría</label>
            <select name="categoria" class="custom-form-control" required>
                <option value="Medicamento" {{ $producto->categoria == 'Medicamento' ? 'selected' : '' }}>Medicamento</option>
                <option value="Alimento" {{ $producto->categoria == 'Alimento' ? 'selected' : '' }}>Alimento</option>
                <option value="Accesorio" {{ $producto->categoria == 'Accesorio' ? 'selected' : '' }}>Accesorio</option>
                <option value="Otro" {{ $producto->categoria == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <div style="flex: 1;">
                <label style="color: white; display: block; margin-bottom: 0.5rem;">Precio ($)</label>
                <input type="number" step="0.01" name="precio" class="custom-form-control" required value="{{ old('precio', $producto->precio) }}">
            </div>
            <div style="flex: 1;">
                <label style="color: white; display: block; margin-bottom: 0.5rem;">Stock Actual</label>
                <input type="number" name="stock" class="custom-form-control" required value="{{ old('stock', $producto->stock) }}">
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="color: white; display: block; margin-bottom: 0.5rem;">Descripción (Opcional)</label>
            <textarea name="descripcion" class="custom-form-control" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn-glass-primary">Actualizar Producto</button>
            <a href="{{ route('productos.index') }}" class="btn-glass-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.dashboard')

@section('titulo_pagina', 'Inventario')

@section('contenido')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <h2 style="margin: 0; color: white;">📦 Inventario</h2>
        <p style="color: #cbd5e1; margin: 0;">Gestión de medicamentos, alimentos y accesorios.</p>
    </div>
    <a href="{{ route('productos.create') }}" class="btn-glass-primary" style="width: auto; padding: 0.5rem 1.5rem;">
        + Nuevo Producto
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
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td><strong>{{ $producto->nombre }}</strong></td>
                <td><span style="background: rgba(255,255,255,0.1); padding: 0.2rem 0.5rem; border-radius: 12px; font-size: 0.8rem;">{{ $producto->categoria }}</span></td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>
                    @if($producto->stock <= 5)
                        <span style="color: #fca5a5; font-weight: bold;">{{ $producto->stock }} (Bajo)</span>
                    @else
                        {{ $producto->stock }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn-glass-sm btn-glass-info">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;" class="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-glass-sm btn-glass-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #94a3b8;">No hay productos registrados aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

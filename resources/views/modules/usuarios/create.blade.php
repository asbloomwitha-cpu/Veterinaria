@extends('layouts.dashboard')

@section('titulo_pagina', 'Nuevo Usuario')

@section('contenido')
<style>
.vet-card {
    background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); color: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.8rem;
}
.form-control-vet {
    border-radius: 12px;
    padding: 0.75rem 1rem;
    border: 1px solid #e3e6f0;
    color: white; background-color: rgba(255, 255, 255, 0.08);
}
.form-control-vet:focus {
    border-color: #7b61ff;
    box-shadow: 0 0 0 0.2rem rgba(123, 97, 255, 0.25);
}
.form-label {
    font-weight: 600;
    color: white;
    margin-bottom: 0.5rem;
}
.btn-vetsystem { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 600; padding: 0.75rem 1.5rem; border: none; }
.btn-vetsystem:hover { background-color: #512da8; color: white; }
.btn-secondary-vet { background-color: rgba(255, 255, 255, 0.08); color: #e2e8f0; border-radius: 12px; font-weight: 600; padding: 0.75rem 1.5rem; border: 1px solid #e3e6f0; }
.btn-secondary-vet:hover { background-color: #eaecf4; color: white; background-color: rgba(255, 255, 255, 0.08); }
</style>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 style="font-weight: 800; color: white; margin-bottom: 0;">Nuevo Usuario</h2>
    </div>
</div>

<div class="vet-card">
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control form-control-vet @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control form-control-vet @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control form-control-vet @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="rol" class="form-label">Rol del Usuario</label>
                <select class="form-control form-control-vet @error('rol') is-invalid @enderror" id="rol" name="rol" required>
                    <option value="" disabled selected>Seleccione un rol...</option>
                    <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="veterinario" {{ old('rol') == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                    <option value="usuario" {{ old('rol') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                </select>
                @error('rol')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mt-4 text-right">
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary-vet mr-2">Cancelar</a>
            <button type="submit" class="btn btn-vetsystem">Guardar Usuario</button>
        </div>
    </form>
</div>
@endsection



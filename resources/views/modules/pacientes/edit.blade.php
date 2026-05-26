@extends('layouts.dashboard')

@section('titulo_pagina', 'Editar Paciente')

@section('contenido')
<style>
.vet-card {
    background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); color: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.5rem;
}
@media (min-width: 768px) {
    .vet-card { padding: 2rem; }
}
.form-control-vet {
    border-radius: 12px;
    padding: 0.8rem 1rem;
    border: 1px solid #e3e6f0;
    color: white; background-color: rgba(255, 255, 255, 0.08);
    height: auto;
    font-size: 1rem;
}
.form-control-vet:focus {
    border-color: #7b61ff;
    box-shadow: 0 0 0 0.2rem rgba(123, 97, 255, 0.25);
}
.form-label {
    font-weight: 700;
    color: white;
    margin-bottom: 0.5rem;
    display: block;
}
.btn-vetsystem { 
    background-color: #7b61ff; 
    color: white; 
    border-radius: 12px; 
    font-weight: 700; 
    padding: 0.8rem 1.5rem; 
    border: none;
    width: 100%;
}
@media (min-width: 576px) {
    .btn-vetsystem { width: auto; }
}
.btn-vetsystem:hover { background-color: #512da8; color: white; }
.btn-secondary-vet { 
    background-color: rgba(255, 255, 255, 0.08); 
    color: #e2e8f0; 
    border-radius: 12px; 
    font-weight: 700; 
    padding: 0.8rem 1.5rem; 
    border: 1px solid #e3e6f0;
    width: 100%;
    margin-bottom: 0.5rem;
}
@media (min-width: 576px) {
    .btn-secondary-vet { width: auto; margin-bottom: 0; }
}
.btn-secondary-vet:hover { background-color: #eaecf4; color: white; background-color: rgba(255, 255, 255, 0.08); }

select.form-control-vet {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
}
</style>

<div class="row mb-4 align-items-center" data-aos="fade-right">
    <div class="col-12">
        <h2 style="font-weight: 800; color: white; margin-bottom: 5px; font-size: 1.75rem;">Editar Paciente</h2>
        <p class="text-muted">Actualiza la información de {{ $paciente->nombre }}.</p>
    </div>
</div>

<div class="vet-card mb-5" data-aos="fade-up">
    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <h5 class="mb-4 text-white font-weight-bold"><i class="fas fa-paw mr-2"></i> Datos de la Mascota</h5>
        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre de la Mascota</label>
                <input type="text" class="form-control form-control-vet @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $paciente->nombre) }}" required>
                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-12 col-sm-6 col-md-3 mb-3">
                <label for="especie" class="form-label">Especie</label>
                <select class="form-control form-control-vet @error('especie') is-invalid @enderror" id="especie" name="especie" required>
                    <option value="Perro" {{ old('especie', $paciente->especie) == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ old('especie', $paciente->especie) == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Ave" {{ old('especie', $paciente->especie) == 'Ave' ? 'selected' : '' }}>Ave</option>
                    <option value="Otro" {{ old('especie', $paciente->especie) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('especie') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-12 col-sm-6 col-md-3 mb-3">
                <label for="raza" class="form-label">Raza</label>
                <input type="text" class="form-control form-control-vet @error('raza') is-invalid @enderror" id="raza" name="raza" value="{{ old('raza', $paciente->raza) }}">
                @error('raza') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 col-sm-4 col-md-2 mb-3">
                <label for="edad" class="form-label">Edad (años)</label>
                <input type="number" class="form-control form-control-vet @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad', $paciente->edad) }}" min="0">
                @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 col-sm-8 col-md-10 mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control form-control-vet @error('observaciones') is-invalid @enderror" id="observaciones" name="observaciones" rows="2">{{ old('observaciones', $paciente->observaciones) }}</textarea>
                @error('observaciones') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 mb-3">
                <label for="foto" class="form-label">Foto de la Mascota</label>
                @if($paciente->foto)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $paciente->foto) }}" alt="Foto de {{ $paciente->nombre }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid #e3e6f0;">
                    </div>
                @endif
                <input type="file" class="form-control form-control-vet @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" style="padding-top: 0.5rem;">
                <small class="text-muted">Si no seleccionas una nueva imagen, se conservará la actual.</small>
                @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <hr class="my-4">
        
        <h5 class="mb-4 text-white font-weight-bold"><i class="fas fa-user mr-2"></i> Información del Propietario</h5>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="p-3 rounded-lg" style="background-color: rgba(255, 255, 255, 0.08); border: 1px dashed rgba(255,255,255,0.2);">
                    <label for="user_id" class="form-label">¿Dueño registrado en el sistema?</label>
                    <select class="form-control form-control-vet @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                        <option value="">-- No registrado / Manual --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('user_id', $paciente->user_id) == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} ({{ $usuario->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="nombre_propietario" class="form-label">Nombre del Dueño (Manual)</label>
                <input type="text" class="form-control form-control-vet @error('nombre_propietario') is-invalid @enderror" id="nombre_propietario" name="nombre_propietario" value="{{ old('nombre_propietario', $paciente->nombre_propietario) }}">
                @error('nombre_propietario') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="telefono_propietario" class="form-label">Teléfono</label>
                <input type="text" class="form-control form-control-vet @error('telefono_propietario') is-invalid @enderror" id="telefono_propietario" name="telefono_propietario" value="{{ old('telefono_propietario', $paciente->telefono_propietario) }}">
                @error('telefono_propietario') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        
        <div class="mt-4 d-flex flex-column flex-sm-row justify-content-end">
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary-vet mr-sm-2 order-2 order-sm-1">Cancelar</a>
            <button type="submit" class="btn btn-vetsystem order-1 order-sm-2">Actualizar Paciente</button>
        </div>
    </form>
</div>
@endsection



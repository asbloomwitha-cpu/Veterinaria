@extends('layouts.dashboard')

@section('titulo_pagina', 'Historial Médico')

@section('contenido')
<style>
.vet-card {
    background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); color: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    padding: 1.8rem;
    height: 100%;
}
.table-clean th { border-top: none; color: #e2e8f0; font-weight: 600; font-size: 0.85rem; padding-bottom: 1rem; border-bottom: 1px solid #f8f9fc; }
.table-clean td { vertical-align: middle; border-top: 1px solid #f8f9fc; padding: 1rem 0.5rem; color: white; background-color: rgba(255, 255, 255, 0.08); font-weight: 600; font-size: 0.9rem; }
.btn-vetsystem { background-color: #7b61ff; color: white; border-radius: 12px; font-weight: 600; padding: 0.5rem 1.5rem; border: none; }
.btn-vetsystem:hover { background-color: #512da8; color: white; }
.btn-action { color: #a0a5ba; background: transparent; border: none; margin-right: 5px; transition: color 0.2s;}
.btn-action.edit:hover { color: #1890ff; }
.btn-action.delete:hover { color: #e74a3b; }
.badge-soft-purple { background-color: #f2eefd; color: #7b61ff; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;}
</style>

<div class="row mb-4 align-items-center">
    <div class="col-md-6" data-aos="fade-right">
        <h2 style="font-weight: 800; color: white; margin-bottom: 0;">Historial Médico</h2>
        <p style="color: #6e707e; font-size: 1.05rem; margin-bottom: 0; font-weight: 500;">Registros clínicos de todos los pacientes.</p>
    </div>
    <div class="col-md-6 text-right" data-aos="fade-left">
        <a href="{{ route('historial.create') }}" class="btn btn-vetsystem">
            <i class="fas fa-file-medical mr-2"></i> Nuevo Registro
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" style="border-radius: 12px; background-color: #e6fcf5; color: #20c997; border: none; font-weight: 600;" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="vet-card" data-aos="fade-up">
    <div class="table-responsive">
        <table class="table table-clean">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Diagnóstico</th>
                    <th>Veterinario</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($historiales as $registro)
                <tr>
                    <td><strong>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</strong></td>
                    <td>
                        <div class="font-weight-bold">{{ $registro->paciente->nombre }}</div>
                        <div class="small text-muted">{{ $registro->paciente->especie }}</div>
                    </td>
                    <td style="color: #e2e8f0; max-width: 300px;">
                        {{ Str::limit($registro->diagnostico, 100) }}
                    </td>
                    <td>
                        <span class="badge-soft-purple">{{ $registro->veterinario->name }}</span>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('historial.edit', $registro->id) }}" class="btn-action edit" title="Ver / Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('historial.destroy', $registro->id) }}" method="POST" class="d-inline form-delete">
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
                    <td colspan="5" class="text-center py-4" style="color: #e2e8f0;">No hay registros médicos aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


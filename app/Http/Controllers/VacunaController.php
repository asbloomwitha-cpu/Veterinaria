<?php

namespace App\Http\Controllers;

use App\Models\Vacuna;
use App\Models\Paciente;
use Illuminate\Http\Request;

class VacunaController extends Controller
{
    public function index()
    {
        $vacunas = Vacuna::with('paciente')->orderBy('fecha_aplicacion', 'desc')->get();
        return view('vacunas.index', compact('vacunas'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
        return view('vacunas.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'nombre' => 'required|string|max:255',
            'fecha_aplicacion' => 'required|date',
            'proxima_dosis' => 'nullable|date|after_or_equal:fecha_aplicacion',
            'observaciones' => 'nullable|string',
        ]);

        Vacuna::create($request->all());

        return redirect()->route('vacunas.index')
            ->with('success', 'Registro de vacuna creado exitosamente.');
    }

    public function edit(Vacuna $vacuna)
    {
        $pacientes = Paciente::all();
        return view('vacunas.edit', compact('vacuna', 'pacientes'));
    }

    public function update(Request $request, Vacuna $vacuna)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'nombre' => 'required|string|max:255',
            'fecha_aplicacion' => 'required|date',
            'proxima_dosis' => 'nullable|date|after_or_equal:fecha_aplicacion',
            'observaciones' => 'nullable|string',
        ]);

        $vacuna->update($request->all());

        return redirect()->route('vacunas.index')
            ->with('success', 'Registro de vacuna actualizado exitosamente.');
    }

    public function destroy(Vacuna $vacuna)
    {
        $vacuna->delete();
        return redirect()->route('vacunas.index')
            ->with('success', 'Registro eliminado exitosamente.');
    }
}

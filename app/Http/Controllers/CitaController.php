<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $query = Cita::with('paciente')->orderBy('fecha_hora', 'asc');
        
        if (auth()->check() && auth()->user()->rol === 'usuario') {
            $query->whereHas('paciente', function($q) {
                $q->where('user_id', auth()->id());
            });
        }

        $citas = $query->get();
        return view('modules.citas.index', compact('citas'));
    }

    public function create()
    {
        if (auth()->check() && auth()->user()->rol === 'usuario') {
            $pacientes = Paciente::where('user_id', auth()->id())->get();
        } else {
            $pacientes = Paciente::all();
        }
        return view('modules.citas.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,en_proceso,completada,cancelada',
            'notas' => 'nullable|string',
        ]);

        if (auth()->check() && auth()->user()->rol === 'usuario') {
            $paciente = Paciente::findOrFail($request->paciente_id);
            if ($paciente->user_id !== auth()->id()) {
                abort(403, 'No tienes permiso para agendar citas de esta mascota.');
            }
        }

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente.');
    }

    public function edit(Cita $cita)
    {
        if (auth()->check() && auth()->user()->rol === 'usuario' && $cita->paciente->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta cita.');
        }

        if (auth()->check() && auth()->user()->rol === 'usuario') {
            $pacientes = Paciente::where('user_id', auth()->id())->get();
        } else {
            $pacientes = Paciente::all();
        }
        return view('modules.citas.edit', compact('cita', 'pacientes'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,en_proceso,completada,cancelada',
            'notas' => 'nullable|string',
        ]);

        if (auth()->check() && auth()->user()->rol === 'usuario' && $cita->paciente->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar esta cita.');
        }

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Cita $cita)
    {
        if (auth()->check() && auth()->user()->rol === 'usuario' && $cita->paciente->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar esta cita.');
        }

        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}

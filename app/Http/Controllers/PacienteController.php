<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Paciente::with('user');

        if (auth()->check() && auth()->user()->rol === 'usuario') {
            $query->where('user_id', auth()->id());
        }

        if ($request->has('buscar') && !empty($request->buscar)) {
            $busqueda = $request->buscar;
            $query->where('nombre', 'like', '%' . $busqueda . '%')
                  ->orWhere('especie', 'like', '%' . $busqueda . '%')
                  ->orWhere('nombre_propietario', 'like', '%' . $busqueda . '%')
                  ->orWhereHas('user', function($q) use ($busqueda) {
                      $q->where('name', 'like', '%' . $busqueda . '%');
                  });
        }

        $pacientes = $query->get();
        return view('modules.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        if (auth()->check() && auth()->user()->rol === 'usuario') {
            // Usuarios no necesitan ver la lista de usuarios, se auto-asignan
            $usuarios = collect([auth()->user()]);
        } else {
            $usuarios = User::where('rol', 'usuario')->get();
        }
        return view('modules.pacientes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'nombre_propietario' => 'required_without:user_id|nullable|string|max:255',
            'telefono_propietario' => 'required_without:user_id|nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pacientes', 'public');
        }

        if (auth()->check() && auth()->user()->rol === 'usuario') {
            $data['user_id'] = auth()->id();
        }

        Paciente::create($data);

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado exitosamente.');
    }

    public function edit(Paciente $paciente)
    {
        if (auth()->check() && auth()->user()->rol === 'usuario' && $paciente->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este paciente.');
        }

        if (auth()->check() && auth()->user()->rol === 'usuario') {
            $usuarios = collect([auth()->user()]);
        } else {
            $usuarios = User::where('rol', 'usuario')->get();
        }
        return view('modules.pacientes.edit', compact('paciente', 'usuarios'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'nombre_propietario' => 'required_without:user_id|nullable|string|max:255',
            'telefono_propietario' => 'required_without:user_id|nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($paciente->foto) {
                Storage::disk('public')->delete($paciente->foto);
            }
            $data['foto'] = $request->file('foto')->store('pacientes', 'public');
        }

        $paciente->update($data);

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado exitosamente.');
    }

    public function destroy(Paciente $paciente)
    {
        if (auth()->check() && auth()->user()->rol === 'usuario' && $paciente->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este paciente.');
        }

        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado exitosamente.');
    }
}

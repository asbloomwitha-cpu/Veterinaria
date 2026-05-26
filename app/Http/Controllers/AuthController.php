<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\Producto;
use App\Models\Vacuna;

class AuthController extends Controller
{
    public function index(){
        return view("modules/auth/login");
    }

    public function registro(){
        return view("modules/auth/registro");
    }

    public function registrar(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'rol' => 'required|in:administrador,veterinario,usuario',
        ]);

        if (in_array($request->rol, ['administrador', 'veterinario'])) {
            if ($request->clave_especial !== 'VETSYSTEM2026') {
                return back()->withErrors(['clave_especial' => 'La clave de autorización es incorrecta.'])->withInput();
            }
        }

        $item = new User();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        $item->rol = $request->rol;
        $item->save();
        return to_route('login')->with('success', 'Usuario registrado exitosamente.');
    }

    public function logear(Request $request) {
        $creadenciales = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($creadenciales)) {
            return to_route('home');
        } else {
            return to_route('login')->with('error', 'Credenciales incorrectas');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return to_route('login');
    }

    public function home() {
        $user = auth()->user();

        if ($user->rol === 'usuario') {
            $misMascotasIds = Paciente::where('user_id', $user->id)->pluck('id');
            $stats = [
                'totalPacientes' => $misMascotasIds->count(),
                'proximasCitas' => Cita::whereIn('paciente_id', $misMascotasIds)->whereDate('fecha_hora', '>=', now()->toDateString())->count(),
                'vacunasPendientes' => Vacuna::whereIn('paciente_id', $misMascotasIds)->whereNotNull('proxima_dosis')->whereDate('proxima_dosis', '<=', now()->addDays(15))->count(),
            ];
            return view('modules.dashboard.home_usuario', compact('stats'));
        }

        $stats = [
            'totalPacientes' => Paciente::count(),
            'citasHoy' => Cita::whereDate('fecha_hora', now()->toDateString())->count(),
            'productosBajoStock' => Producto::where('stock', '<=', 5)->count(),
            'vacunasPendientes' => Vacuna::whereNotNull('proxima_dosis')->whereDate('proxima_dosis', '<=', now()->addDays(15))->count(),
        ];

        return view('modules.dashboard.home', compact('stats'));
    }
}

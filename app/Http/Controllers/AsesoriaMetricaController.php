<?php

namespace App\Http\Controllers;

use App\Models\Asesoria;
use App\Models\AsesoriaMetrica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesoriaMetricaController extends Controller
{
    /**
     * Almacena la métrica de acceso a la sala y redirige al enlace.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asesoria_id' => 'required|exists:asesorias,id',
        ]);

        $asesoria = Asesoria::findOrFail($request->asesoria_id);
        $user = Auth::user();

        // Registrar la métrica
        AsesoriaMetrica::create([
            'asesoria_id'    => $asesoria->id,
            'user_id'        => $user->id,
            'nombre_completo'=> $user->nombre_completo,
            'email'          => $user->email,
            'rol'            => $user->rol,
        ]);

        // Redireccionar al enlace de la sala (usando redirect()->away para URL externas)
        return redirect()->away($asesoria->enlace_sala);
    }

    /**
     * Muestra una vista con las métricas registradas.
     */
    public function index()
    {
        $metricas = AsesoriaMetrica::with('asesoria', 'user')->get();
        return view('metricas.index', compact('metricas'));
    }
}

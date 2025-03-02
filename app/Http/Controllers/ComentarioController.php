<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    /**
     * Almacena un comentario o respuesta.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'capsula_id' => 'required|exists:capsulas,id',
            'contenido'  => 'required|string',
            'parent_id'  => 'nullable|exists:comentarios,id'
        ]);

        // Validar palabras prohibidas (puedes ampliar la lista)
        $palabrasProhibidas = ['palabra1', 'palabra2'];
        foreach ($palabrasProhibidas as $palabra) {
            if (stripos($data['contenido'], $palabra) !== false) {
                return back()->withErrors(['contenido' => 'Tu comentario contiene palabras no permitidas.'])->withInput();
            }
        }

        $data['user_id'] = Auth::id();
        Comentario::create($data);

        return back()->with('success', 'Comentario agregado exitosamente.');
    }

    /**
     * Registra o actualiza la reacción (like/dislike) de un comentario.
     */
    public function reaccion(Request $request, Comentario $comentario)
    {
        $data = $request->validate([
            'tipo' => 'required|in:like,dislike'
        ]);

        // Verificar si el usuario ya reaccionó al comentario
        $existing = $comentario->reacciones()->where('user_id', Auth::id())->first();

        if ($existing) {
            if ($existing->tipo === $data['tipo']) {
                // Si la reacción es la misma, se elimina (toggle off)
                $existing->delete();
            } else {
                // Si es distinta, se actualiza
                $existing->update(['tipo' => $data['tipo']]);
            }
        } else {
            $comentario->reacciones()->create([
                'user_id' => Auth::id(),
                'tipo'    => $data['tipo']
            ]);
        }

        return back();
    }
}

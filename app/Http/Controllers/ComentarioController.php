<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Capsula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    /**
     * Almacena un comentario o respuesta.
     */
    public function store(Request $request)
    {
        // Si se envía el campo "capsula_id", se asume que es un comentario sobre una cápsula.
        if ($request->has('capsula_id')) {
            $data = $request->validate([
                'capsula_id' => 'required',
                'contenido'  => 'required|string',
                'parent_id'  => 'nullable|exists:comentarios,id'
            ]);
            // Se asignan los campos para la relación polimórfica
            $data['commentable_id'] = $data['capsula_id'];
            $data['commentable_type'] = Capsula::class;
        } else {
            // Validación original para otros tipos (ej. documento)
            $data = $request->validate([
                'commentable_id' => 'required',
                'commentable_type' => 'required|string',
                'contenido'  => 'required|string',
                'parent_id'  => 'nullable|exists:comentarios,id'
            ]);
        }

        // Validar palabras prohibidas (lista ampliable)
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

        $existing = $comentario->reacciones()->where('user_id', Auth::id())->first();

        if ($existing) {
            if ($existing->tipo === $data['tipo']) {
                $existing->delete();
            } else {
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

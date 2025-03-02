<?php

namespace App\Http\Controllers;

use App\Models\Capsula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CapsulaController extends Controller
{
    /**
     * Muestra la lista de cápsulas.
     */
    public function index()
    {
        $capsulas = Capsula::with('docente')->get();
        return view('capsulas.index', compact('capsulas'));
    }

    /**
     * Muestra el formulario para crear una nueva cápsula.
     */
    public function create()
    {
        return view('capsulas.create');
    }

    /**
     * Almacena la nueva cápsula en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación básica
        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'video_url'   => 'nullable|url',
            'video_file'  => 'nullable|mimes:mp4,avi,wmv,mov|max:20480', // máximo 20MB
            'categoria'   => 'nullable|string|max:255',
        ]);

        // Se exige que se proporcione al menos una opción: URL o archivo de video
        if (empty($validated['video_url']) && !$request->hasFile('video_file')) {
            return back()->withErrors(['video' => 'Debe proporcionar una URL o subir un video.'])->withInput();
        }

        // Si se sube un archivo, se procesa la carga
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $path = $file->store('videos', 'public');
            // Se guarda la URL pública del archivo
            $validated['video_url'] = asset('storage/' . $path);
        }

        // Se asigna el docente autenticado
        $validated['docente_id'] = Auth::id();

        // Valor por defecto para 'duracion'
        $validated['duracion'] = 0;

        Capsula::create($validated);

        return redirect()->route('capsulas.index')->with('success', 'Cápsula creada exitosamente.');
    }

    /**
     * Muestra los detalles de una cápsula.
     */
    public function show($id)
    {
        $capsula = Capsula::with('docente', 'comentarios')->findOrFail($id);
        return view('capsulas.show', compact('capsula'));
    }

    /**
     * Muestra el formulario para editar una cápsula.
     */
    public function edit($id)
    {
        $capsula = Capsula::findOrFail($id);
        return view('capsulas.edit', compact('capsula'));
    }

    /**
     * Actualiza la cápsula en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $capsula = Capsula::findOrFail($id);
        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'video_url'   => 'nullable|url',
            'video_file'  => 'nullable|mimes:mp4,avi,wmv,mov|max:20480',
            'categoria'   => 'nullable|string|max:255',
        ]);

        // Se exige que se proporcione al menos una opción: URL o archivo de video
        if (empty($validated['video_url']) && !$request->hasFile('video_file')) {
            return back()->withErrors(['video' => 'Debe proporcionar una URL o subir un video.'])->withInput();
        }

        // Si se sube un archivo, se procesa la carga
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $path = $file->store('videos', 'public');
            $validated['video_url'] = asset('storage/' . $path);
        } else {
            // Si no se sube archivo, se conserva la URL actual o se actualiza la proporcionada
            $validated['video_url'] = $validated['video_url'] ?? $capsula->video_url;
        }

        // Se mantiene la duración actual si no se actualiza
        $validated['duracion'] = $capsula->duracion ?? 0;

        $capsula->update($validated);

        return redirect()->route('capsulas.index')->with('success', 'Cápsula actualizada exitosamente.');
    }

    /**
     * Elimina una cápsula.
     */
    public function destroy($id)
    {
        $capsula = Capsula::findOrFail($id);
        $capsula->delete();

        return redirect()->route('capsulas.index')->with('success', 'Cápsula eliminada exitosamente.');
    }
}

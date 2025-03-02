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
        // Solo admin y docentes pueden crear cápsulas.
        $this->authorize('create', Capsula::class);
        return view('capsulas.create');
    }

    /**
     * Almacena la nueva cápsula en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Capsula::class);

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
            $validated['video_url'] = asset('storage/' . $path);
        }

        // Se asigna el docente autenticado; si el usuario es docente, forzamos que la cápsula le pertenezca.
        if (auth()->user()->rol === 'docente') {
            $validated['docente_id'] = auth()->id();
        } else {
            // En el caso de admin, se puede enviar el docente_id desde el formulario o asignar un valor por defecto.
            $validated['docente_id'] = $request->input('docente_id') ?? auth()->id();
        }

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
        // Solo admin o el docente dueño de la cápsula pueden editarla.
        $this->authorize('update', $capsula);
        return view('capsulas.edit', compact('capsula'));
    }

    /**
     * Actualiza la cápsula en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $capsula = Capsula::findOrFail($id);
        $this->authorize('update', $capsula);

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
            $validated['video_url'] = $validated['video_url'] ?? $capsula->video_url;
        }

        $validated['duracion'] = $capsula->duracion ?? 0;

        // Si el usuario es docente, forzamos que la cápsula pertenezca a él.
        if (auth()->user()->rol === 'docente') {
            $validated['docente_id'] = auth()->id();
        }

        $capsula->update($validated);

        return redirect()->route('capsulas.index')->with('success', 'Cápsula actualizada exitosamente.');
    }

    /**
     * Elimina una cápsula.
     */
    public function destroy($id)
    {
        $capsula = Capsula::findOrFail($id);
        $this->authorize('delete', $capsula);
        $capsula->delete();

        return redirect()->route('capsulas.index')->with('success', 'Cápsula eliminada exitosamente.');
    }
}

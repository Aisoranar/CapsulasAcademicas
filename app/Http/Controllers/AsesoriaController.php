<?php

namespace App\Http\Controllers;

use App\Models\Asesoria;
use App\Models\User;
use Illuminate\Http\Request;

class AsesoriaController extends Controller
{
    /**
     * Muestra la lista de asesorías.
     */
    public function index()
    {
        // Se cargan las relaciones de docente y estudiantes para cada asesoría.
        $asesorias = Asesoria::with('docente', 'estudiantes')->get();
        return view('asesorias.index', compact('asesorias'));
    }

    /**
     * Muestra el formulario para crear una nueva asesoría.
     */
    public function create()
    {
        // Autoriza la creación (la policy debe permitir solo a admin y docentes).
        $this->authorize('create', Asesoria::class);

        // Se obtiene la lista de docentes para que el usuario elija (o para mostrar, según convenga).
        $docentes = User::where('rol', 'docente')->get();
        return view('asesorias.create', compact('docentes'));
    }

    /**
     * Almacena la nueva asesoría en la base de datos.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Asesoria::class);

        $validated = $request->validate([
            'docente_id'  => 'required|exists:users,id',
            'materia'     => 'required|string|max:255',
            'tema'        => 'required|string|max:255',
            'fecha'       => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required',
            'enlace_sala' => 'required|url',
        ]);

        // Si el usuario autenticado es docente, forzamos que la asesoría pertenezca a él.
        if (auth()->user()->rol === 'docente') {
            $validated['docente_id'] = auth()->id();
        }

        Asesoria::create($validated);

        return redirect()->route('asesorias.index')->with('success', 'Asesoría creada exitosamente.');
    }

    /**
     * Muestra los detalles de una asesoría en particular.
     * Esta acción es accesible para cualquier usuario autenticado.
     */
    public function show($id)
    {
        $asesoria = Asesoria::with('docente', 'estudiantes')->findOrFail($id);
        return view('asesorias.show', compact('asesoria'));
    }

    /**
     * Muestra el formulario para editar una asesoría existente.
     */
    public function edit($id)
    {
        $asesoria = Asesoria::findOrFail($id);
        // Autoriza que el usuario pueda editar la asesoría.
        $this->authorize('update', $asesoria);

        $docentes = User::where('rol', 'docente')->get();
        return view('asesorias.edit', compact('asesoria', 'docentes'));
    }

    /**
     * Actualiza la asesoría en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $asesoria = Asesoria::findOrFail($id);
        // Autoriza que el usuario pueda actualizar la asesoría.
        $this->authorize('update', $asesoria);

        $validated = $request->validate([
            'docente_id'  => 'required|exists:users,id',
            'materia'     => 'required|string|max:255',
            'tema'        => 'required|string|max:255',
            'fecha'       => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin'    => 'required',
            'enlace_sala' => 'required|url',
        ]);

        // Si el usuario autenticado es docente, forzamos que la asesoría pertenezca a él.
        if (auth()->user()->rol === 'docente') {
            $validated['docente_id'] = auth()->id();
        }

        $asesoria->update($validated);

        return redirect()->route('asesorias.index')->with('success', 'Asesoría actualizada exitosamente.');
    }

    /**
     * Elimina una asesoría.
     */
    public function destroy($id)
    {
        $asesoria = Asesoria::findOrFail($id);
        // Autoriza que el usuario pueda eliminar la asesoría.
        $this->authorize('delete', $asesoria);

        $asesoria->delete();

        return redirect()->route('asesorias.index')->with('success', 'Asesoría eliminada exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Capsula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'video_url'   => 'required|url',
            'categoria'   => 'nullable|string|max:255',
        ]);

        // Se asigna el docente autenticado
        $validated['docente_id'] = Auth::id();

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
            'video_url'   => 'required|url',
            'categoria'   => 'nullable|string|max:255',
        ]);

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

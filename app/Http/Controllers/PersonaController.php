<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::with(['vehiculos', 'polizas'])
            ->orderBy('nombre')
            ->paginate(10);

        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        return view('personas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'required|string|max:100',
            'email'            => 'required|email|unique:personas',
            'telefono'         => 'required|string|max:20',
            'direccion'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
        ]);

        Persona::create($validated);

        return redirect()
            ->route('personas.index')
            ->with('success', 'Persona registrada correctamente');
    }

    public function show(Persona $persona)
    {
        $persona->load(['vehiculos', 'polizas.accidentes', 'accidentes.municipio']);

        return view('personas.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'required|string|max:100',
            'email'            => 'required|email|unique:personas,email,' . $persona->id,
            'telefono'         => 'required|string|max:20',
            'direccion'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
        ]);

        $persona->update($validated);

        return redirect()
            ->route('personas.index')
            ->with('success', 'Persona actualizada correctamente');
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();

        return redirect()
            ->route('personas.index')
            ->with('success', 'Persona eliminada');
    }
}

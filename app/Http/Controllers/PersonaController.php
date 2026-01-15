<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Mostrar listado de personas
     */
    public function index()
    {
        $personas = Persona::with(['vehiculos', 'polizas'])
            ->orderBy('nombre')
            ->paginate(10);

        return view('personas.index', compact('personas'));
    }

    /**
     * Mostrar detalle de una persona
     */
    public function show(Persona $persona)
    {
        $persona->load(['vehiculos', 'polizas.accidentes']);

        return view('personas.show', compact('persona'));
    }
}

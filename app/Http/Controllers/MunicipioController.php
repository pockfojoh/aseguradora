<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {
        $municipios = Municipio::withCount('accidentes')
            ->orderBy('nombre')
            ->paginate(10);

        return view('municipios.index', compact('municipios'));
    }

    public function create()
    {
        return view('municipios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
        ]);

        Municipio::create($validated);

        return redirect()
            ->route('municipios.index')
            ->with('success', 'Municipio registrado correctamente');
    }

    public function show(Municipio $municipio)
    {
        $municipio->load(['accidentes' => function ($query) {
            $query->with(['persona', 'vehiculo'])->latest('fecha_accidente')->limit(10);
        }]);
        $municipio->loadCount('accidentes');

        $totalAccidentes = $municipio->accidentes_count;
        $accidentes = $municipio->accidentes;

        return view('municipios.show', compact('municipio', 'totalAccidentes', 'accidentes'));
    }

    public function edit(Municipio $municipio)
    {
        return view('municipios.edit', compact('municipio'));
    }

    public function update(Request $request, Municipio $municipio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
        ]);

        $municipio->update($validated);

        return redirect()
            ->route('municipios.index')
            ->with('success', 'Municipio actualizado correctamente');
    }

    public function destroy(Municipio $municipio)
    {
        $municipio->delete();

        return redirect()
            ->route('municipios.index')
            ->with('success', 'Municipio eliminado');
    }
}

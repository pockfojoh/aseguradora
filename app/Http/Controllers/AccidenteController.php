<?php

namespace App\Http\Controllers;

use App\Models\Accidente;
use App\Models\Poliza;
use App\Models\Municipio;
use Illuminate\Http\Request;

class AccidenteController extends Controller
{
    public function index()
    {
        $accidentes = Accidente::with([
                'persona',
                'vehiculo',
                'poliza',
                'municipio'
            ])
            ->orderByDesc('fecha_accidente')
            ->paginate(15);

        return view('accidentes.index', compact('accidentes'));
    }

    public function create()
    {
        $polizas = Poliza::with(['persona', 'vehiculo'])
            ->where('estado', 'activa')
            ->get();
        $municipios = Municipio::orderBy('nombre')->get();

        return view('accidentes.create', compact('polizas', 'municipios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'poliza_id'       => 'required|exists:polizas,id',
            'municipio_id'    => 'required|exists:municipios,id',
            'fecha_accidente' => 'required|date',
            'hora_accidente'  => 'required',
            'descripcion'     => 'required|string',
            'gravedad'        => 'required|in:leve,moderado,grave',
            'monto_danios'    => 'required|numeric|min:0',
            'ubicacion'       => 'nullable|string|max:255',
        ]);

        $poliza = Poliza::find($validated['poliza_id']);
        $validated['persona_id'] = $poliza->persona_id;
        $validated['vehiculo_id'] = $poliza->vehiculo_id;

        Accidente::create($validated);

        return redirect()
            ->route('accidentes.index')
            ->with('success', 'Accidente registrado correctamente');
    }

    public function show(Accidente $accidente)
    {
        $accidente->load([
            'persona',
            'vehiculo',
            'poliza',
            'municipio'
        ]);

        return view('accidentes.show', compact('accidente'));
    }

    public function edit(Accidente $accidente)
    {
        $polizas = Poliza::with(['persona', 'vehiculo'])->get();
        $municipios = Municipio::orderBy('nombre')->get();

        return view('accidentes.edit', compact('accidente', 'polizas', 'municipios'));
    }

    public function update(Request $request, Accidente $accidente)
    {
        $validated = $request->validate([
            'poliza_id'       => 'required|exists:polizas,id',
            'municipio_id'    => 'required|exists:municipios,id',
            'fecha_accidente' => 'required|date',
            'hora_accidente'  => 'required',
            'descripcion'     => 'required|string',
            'gravedad'        => 'required|in:leve,moderado,grave',
            'monto_danios'    => 'required|numeric|min:0',
            'ubicacion'       => 'nullable|string|max:255',
        ]);

        $poliza = Poliza::find($validated['poliza_id']);
        $validated['persona_id'] = $poliza->persona_id;
        $validated['vehiculo_id'] = $poliza->vehiculo_id;

        $accidente->update($validated);

        return redirect()
            ->route('accidentes.index')
            ->with('success', 'Accidente actualizado correctamente');
    }

    public function destroy(Accidente $accidente)
    {
        $accidente->delete();

        return redirect()
            ->route('accidentes.index')
            ->with('success', 'Accidente eliminado');
    }
}

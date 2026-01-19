<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Persona;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('persona')
            ->orderBy('marca')
            ->paginate(10);

        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $personas = Persona::orderBy('nombre')->get();
        return view('vehiculos.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'persona_id'   => 'required|exists:personas,id',
            'marca'        => 'required|string|max:100',
            'modelo'       => 'required|string|max:100',
            'anio'         => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'placa'        => 'required|string|max:20|unique:vehiculos',
            'color'        => 'required|string|max:50',
            'numero_serie' => 'required|string|max:50|unique:vehiculos',
        ]);
        
        Vehiculo::create($validated);

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo registrado correctamente');
    }

    public function show(Vehiculo $vehiculo)
    {
        $vehiculo->load(['persona', 'polizas', 'accidentes.municipio']);
        return view('vehiculos.show', compact('vehiculo'));
    }

    public function edit(Vehiculo $vehiculo)
    {
        $personas = Persona::orderBy('nombre')->get();
        return view('vehiculos.edit', compact('vehiculo', 'personas'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $validated = $request->validate([
            'persona_id'   => 'required|exists:personas,id',
            'marca'        => 'required|string|max:100',
            'modelo'       => 'required|string|max:100',
            'anio'         => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'placa'        => 'required|string|max:20|unique:vehiculos,placa,' . $vehiculo->id,
            'color'        => 'required|string|max:50',
            'numero_serie' => 'required|string|max:50|unique:vehiculos,numero_serie,' . $vehiculo->id,
        ]);

        $vehiculo->update($validated);

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado correctamente');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()
            ->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Poliza;
use App\Models\Persona;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class PolizaController extends Controller
{
    /**
     * Mostrar listado de pólizas
     */
    public function index()
    {
        $polizas = Poliza::with(['persona', 'vehiculo'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('polizas.index', compact('polizas'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $personas = Persona::orderBy('nombre')->get();
        $vehiculos = Vehiculo::orderBy('marca')->get();

        return view('polizas.create', compact('personas', 'vehiculos'));
    }

    /**
     * Guardar póliza
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'persona_id'        => 'required|exists:personas,id',
            'vehiculo_id'       => 'required|exists:vehiculos,id',
            'numero_poliza'     => 'required|unique:polizas',
            'fecha_compra'      => 'required|date',
            'fecha_vencimiento' => 'required|date|after:fecha_compra',
            'monto_cobertura'   => 'required|numeric|min:0',
            'prima_mensual'     => 'required|numeric|min:0',
            'tipo_cobertura'    => 'required|in:basica,intermedia,completa',
            'estado'            => 'required|in:activa,vencida,cancelada',
        ]);

        Poliza::create($validated);

        return redirect()
            ->route('polizas.index')
            ->with('success', 'Póliza creada correctamente');
    }

    /**
     * Mostrar una póliza
     */
    public function show(Poliza $poliza)
    {
        $poliza->load(['persona', 'vehiculo', 'accidentes']);

        return view('polizas.show', compact('poliza'));
    }

    /**
     * Formulario de edición
     */
    public function edit(Poliza $poliza)
    {
        $personas = Persona::orderBy('nombre')->get();
        $vehiculos = Vehiculo::orderBy('marca')->get();

        return view('polizas.edit', compact('poliza', 'personas', 'vehiculos'));
    }

    /**
     * Actualizar póliza
     */
    public function update(Request $request, Poliza $poliza)
    {
        $validated = $request->validate([
            'persona_id'        => 'required|exists:personas,id',
            'vehiculo_id'       => 'required|exists:vehiculos,id',
            'numero_poliza'     => 'required|unique:polizas,numero_poliza,' . $poliza->id,
            'fecha_compra'      => 'required|date',
            'fecha_vencimiento' => 'required|date|after:fecha_compra',
            'monto_cobertura'   => 'required|numeric|min:0',
            'prima_mensual'     => 'required|numeric|min:0',
            'tipo_cobertura'    => 'required|in:basica,intermedia,completa',
            'estado'            => 'required|in:activa,vencida,cancelada',
        ]);

        $poliza->update($validated);

        return redirect()
            ->route('polizas.index')
            ->with('success', 'Póliza actualizada correctamente');
    }

    /**
     * Eliminar póliza
     */
    public function destroy(Poliza $poliza)
    {
        $poliza->delete();

        return redirect()
            ->route('polizas.index')
            ->with('success', 'Póliza eliminada');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Vehiculo;
use App\Models\Poliza;
use App\Models\Accidente;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// app/Http/Controllers/DashboardController.php
class DashboardController extends Controller
{
    public function index()
    {
        // Hora con mayor cantidad de accidentes
        $horaMayorAccidentes = Accidente::select(
            DB::raw('HOUR(hora_accidente) as hora'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('hora')
        ->orderByDesc('total')
        ->first();

        // Municipios con mayor cantidad de accidentes
        $municipiosMayorAccidentes = Municipio::select(
            'municipios.nombre',
            'municipios.estado',
            DB::raw('COUNT(accidentes.id) as total_accidentes')
        )
        ->join('accidentes', 'municipios.id', '=', 'accidentes.municipio_id')
        ->groupBy('municipios.id', 'municipios.nombre', 'municipios.estado')
        ->orderByDesc('total_accidentes')
        ->limit(10)
        ->get();

        // Personas con mayor índice de accidentes
        $personasMayorAccidentes = Persona::select(
            'personas.id',
            'personas.nombre',
            'personas.apellido',
            DB::raw('COUNT(accidentes.id) as total_accidentes')
        )
        ->join('accidentes', 'personas.id', '=', 'accidentes.persona_id')
        ->groupBy('personas.id', 'personas.nombre', 'personas.apellido')
        ->orderByDesc('total_accidentes')
        ->limit(10)
        ->get();

        // Personas con menor índice de accidentes (que tienen póliza pero pocos/ningún accidente)
        $personasMenorAccidentes = Persona::select(
            'personas.id',
            'personas.nombre',
            'personas.apellido',
            DB::raw('COUNT(DISTINCT polizas.id) as total_polizas'),
            DB::raw('COUNT(DISTINCT accidentes.id) as total_accidentes')
        )
        ->join('polizas', 'personas.id', '=', 'polizas.persona_id')
        ->leftJoin('accidentes', 'personas.id', '=', 'accidentes.persona_id')
        ->groupBy('personas.id', 'personas.nombre', 'personas.apellido')
        ->orderBy('total_accidentes', 'asc')
        ->limit(10)
        ->get();

        return view('dashboard', compact(
            'horaMayorAccidentes',
            'municipiosMayorAccidentes',
            'personasMayorAccidentes',
            'personasMenorAccidentes'
        ));
    }
}

// app/Http/Controllers/PersonaController.php
class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::with(['polizas', 'vehiculos', 'accidentes'])->paginate(15);
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        return view('personas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:personas',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        Persona::create($validated);
        return redirect()->route('personas.index')->with('success', 'Persona creada exitosamente');
    }

    public function show(Persona $persona)
    {
        $persona->load(['polizas.vehiculo', 'accidentes.municipio', 'vehiculos']);
        return view('personas.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:personas,email,' . $persona->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $persona->update($validated);
        return redirect()->route('personas.index')->with('success', 'Persona actualizada exitosamente');
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('personas.index')->with('success', 'Persona eliminada exitosamente');
    }
}

// app/Http/Controllers/PolizaController.php
class PolizaController extends Controller
{
    public function index()
    {
        $polizas = Poliza::with(['persona', 'vehiculo'])->paginate(15);
        return view('polizas.index', compact('polizas'));
    }

    public function create()
    {
        $personas = Persona::all();
        $vehiculos = Vehiculo::with('persona')->get();
        return view('polizas.create', compact('personas', 'vehiculos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_poliza' => 'required|string|max:50|unique:polizas',
            'persona_id' => 'required|exists:personas,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_compra' => 'required|date',
            'fecha_vencimiento' => 'required|date|after:fecha_compra',
            'monto_cobertura' => 'required|numeric|min:0',
            'prima_mensual' => 'required|numeric|min:0',
            'tipo_cobertura' => 'required|in:basica,intermedia,completa',
            'estado' => 'required|in:activa,cancelada,vencida',
        ]);

        Poliza::create($validated);
        return redirect()->route('polizas.index')->with('success', 'Póliza creada exitosamente');
    }

    public function show(Poliza $poliza)
    {
        $poliza->load(['persona', 'vehiculo.persona', 'accidentes']);
        return view('polizas.show', compact('poliza'));
    }

    public function edit(Poliza $poliza)
    {
        $personas = Persona::all();
        $vehiculos = Vehiculo::with('persona')->get();
        return view('polizas.edit', compact('poliza', 'personas', 'vehiculos'));
    }

    public function update(Request $request, Poliza $poliza)
    {
        $validated = $request->validate([
            'numero_poliza' => 'required|string|max:50|unique:polizas,numero_poliza,' . $poliza->id,
            'persona_id' => 'required|exists:personas,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_compra' => 'required|date',
            'fecha_vencimiento' => 'required|date|after:fecha_compra',
            'monto_cobertura' => 'required|numeric|min:0',
            'prima_mensual' => 'required|numeric|min:0',
            'tipo_cobertura' => 'required|in:basica,intermedia,completa',
            'estado' => 'required|in:activa,cancelada,vencida',
        ]);

        $poliza->update($validated);
        return redirect()->route('polizas.index')->with('success', 'Póliza actualizada exitosamente');
    }

    public function destroy(Poliza $poliza)
    {
        $poliza->delete();
        return redirect()->route('polizas.index')->with('success', 'Póliza eliminada exitosamente');
    }
}

// app/Http/Controllers/AccidenteController.php
class AccidenteController extends Controller
{
    public function index()
    {
        $accidentes = Accidente::with(['persona', 'vehiculo', 'poliza', 'municipio'])
            ->orderByDesc('fecha_accidente')
            ->paginate(15);
        return view('accidentes.index', compact('accidentes'));
    }

    public function create()
    {
        $polizas = Poliza::with(['persona', 'vehiculo'])->where('estado', 'activa')->get();
        $municipios = Municipio::all();
        return view('accidentes.create', compact('polizas', 'municipios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'poliza_id' => 'required|exists:polizas,id',
            'municipio_id' => 'required|exists:municipios,id',
            'fecha_accidente' => 'required|date',
            'hora_accidente' => 'required',
            'descripcion' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderado,grave',
            'monto_danios' => 'nullable|numeric|min:0',
            'ubicacion' => 'nullable|string',
        ]);

        $poliza = Poliza::findOrFail($validated['poliza_id']);
        $validated['persona_id'] = $poliza->persona_id;
        $validated['vehiculo_id'] = $poliza->vehiculo_id;

        Accidente::create($validated);
        return redirect()->route('accidentes.index')->with('success', 'Accidente registrado exitosamente');
    }

    public function show(Accidente $accidente)
    {
        $accidente->load(['persona', 'vehiculo', 'poliza', 'municipio']);
        return view('accidentes.show', compact('accidente'));
    }

    public function edit(Accidente $accidente)
    {
        $polizas = Poliza::with(['persona', 'vehiculo'])->get();
        $municipios = Municipio::all();
        return view('accidentes.edit', compact('accidente', 'polizas', 'municipios'));
    }

    public function update(Request $request, Accidente $accidente)
    {
        $validated = $request->validate([
            'poliza_id' => 'required|exists:polizas,id',
            'municipio_id' => 'required|exists:municipios,id',
            'fecha_accidente' => 'required|date',
            'hora_accidente' => 'required',
            'descripcion' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderado,grave',
            'monto_danios' => 'nullable|numeric|min:0',
            'ubicacion' => 'nullable|string',
        ]);

        $poliza = Poliza::findOrFail($validated['poliza_id']);
        $validated['persona_id'] = $poliza->persona_id;
        $validated['vehiculo_id'] = $poliza->vehiculo_id;

        $accidente->update($validated);
        return redirect()->route('accidentes.index')->with('success', 'Accidente actualizado exitosamente');
    }

    public function destroy(Accidente $accidente)
    {
        $accidente->delete();
        return redirect()->route('accidentes.index')->with('success', 'Accidente eliminado exitosamente');
    }
}
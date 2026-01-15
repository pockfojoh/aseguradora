<?php

namespace App\Http\Controllers;

use App\Models\Accidente;
use Illuminate\Http\Request;

class AccidenteController extends Controller
{
    /**
     * Listado de accidentes
     */
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

    /**
     * Detalle de un accidente
     */
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
}

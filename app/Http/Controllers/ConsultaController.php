<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Poliza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    /**
     * Consulta: Información completa de persona con sus pólizas y vehículos
     */
    public function personaPoliza(Request $request)
    {
        $query = Persona::with(['polizas.vehiculo', 'vehiculos']);

        // Filtro de búsqueda por nombre
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'LIKE', "%{$buscar}%")
                  ->orWhere('apellido', 'LIKE', "%{$buscar}%")
                  ->orWhere('email', 'LIKE', "%{$buscar}%");
            });
        }

        // Filtro por estado de póliza
        if ($request->filled('estado_poliza')) {
            $query->whereHas('polizas', function($q) use ($request) {
                $q->where('estado', $request->estado_poliza);
            });
        }

        // Ordenar por cantidad de accidentes
        if ($request->filled('orden')) {
            if ($request->orden == 'mas_accidentes') {
                $query->withCount('accidentes')->orderByDesc('accidentes_count');
            } elseif ($request->orden == 'menos_accidentes') {
                $query->withCount('accidentes')->orderBy('accidentes_count');
            }
        }

        $personas = $query->paginate(10);

        // Datos adicionales para cada persona
        foreach ($personas as $persona) {
            $persona->total_accidentes = $persona->accidentes()->count();
            $persona->polizas_activas = $persona->polizas()->where('estado', 'activa')->count();
        }

        return view('consultas.persona-poliza', compact('personas'));
    }

    /**
     * Exportar consulta a CSV
     */
    public function exportarConsulta(Request $request)
    {
        $personas = Persona::with(['polizas.vehiculo', 'accidentes'])->get();

        $filename = 'consulta_personas_polizas_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($personas) {
            $file = fopen('php://output', 'w');
            
            // Encabezados del CSV
            fputcsv($file, [
                'ID Persona',
                'Nombre Completo',
                'Email',
                'Teléfono',
                'Número Póliza',
                'Fecha Compra',
                'Fecha Vencimiento',
                'Estado Póliza',
                'Tipo Cobertura',
                'Prima Mensual',
                'Marca Vehículo',
                'Modelo Vehículo',
                'Año',
                'Placa',
                'Total Accidentes'
            ]);

            // Datos
            foreach ($personas as $persona) {
                foreach ($persona->polizas as $poliza) {
                    fputcsv($file, [
                        $persona->id,
                        $persona->nombre_completo,
                        $persona->email,
                        $persona->telefono,
                        $poliza->numero_poliza,
                        $poliza->fecha_compra->format('Y-m-d'),
                        $poliza->fecha_vencimiento->format('Y-m-d'),
                        $poliza->estado,
                        $poliza->tipo_cobertura,
                        $poliza->prima_mensual,
                        $poliza->vehiculo->marca,
                        $poliza->vehiculo->modelo,
                        $poliza->vehiculo->anio,
                        $poliza->vehiculo->placa,
                        $persona->accidentes->count()
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Reporte detallado por persona
     */
    public function reportePersona(Persona $persona)
    {
        $persona->load([
            'polizas.vehiculo',
            'polizas.accidentes.municipio',
            'accidentes.municipio'
        ]);

        // Estadísticas de la persona
        $estadisticas = [
            'total_polizas' => $persona->polizas->count(),
            'polizas_activas' => $persona->polizas->where('estado', 'activa')->count(),
            'total_accidentes' => $persona->accidentes->count(),
            'monto_total_danios' => $persona->accidentes->sum('monto_danios'),
            'accidentes_por_gravedad' => $persona->accidentes->groupBy('gravedad')->map->count(),
            'municipio_mas_accidentes' => $persona->accidentes
                ->groupBy('municipio.nombre')
                ->sortByDesc(function($accidentes) {
                    return $accidentes->count();
                })
                ->keys()
                ->first(),
        ];

        // Historial de accidentes por mes
        $accidentesPorMes = $persona->accidentes()
            ->select(
                DB::raw('YEAR(fecha_accidente) as year'),
                DB::raw('MONTH(fecha_accidente) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->limit(12)
            ->get();

        return view('consultas.reporte-persona', compact('persona', 'estadisticas', 'accidentesPorMes'));
    }



    /**
     * Panel de consultas generales
     */
    public function index()
    {
        return view('consultas.index');
    }

    /**
     * Estadísticas básicas
     */
    public function estadisticas()
    {
        $totalPolizas = Poliza::count();
        $polizasActivas = Poliza::where('estado', 'activa')->count();
        $totalAccidentes = Accidente::count();

        $accidentesPorMunicipio = Accidente::with('municipio')
            ->selectRaw('municipio_id, COUNT(*) as total')
            ->groupBy('municipio_id')
            ->get();

        $accidentesPorHora = Accidente::selectRaw('HOUR(hora_accidente) as hora, COUNT(*) as total')
            ->groupBy('hora')
            ->orderBy('hora')
            ->get();

        return view('consultas.estadisticas', compact(
            'totalPolizas',
            'polizasActivas',
            'totalAccidentes',
            'accidentesPorMunicipio',
            'accidentesPorHora'
        ));
    }


}
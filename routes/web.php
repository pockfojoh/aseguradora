<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\PolizaController;
use App\Http\Controllers\AccidenteController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ConsultaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Personas CRUD
    Route::resource('personas', PersonaController::class);
    
    // Vehículos CRUD
    Route::resource('vehiculos', VehiculoController::class);
    
    // Pólizas CRUD
    Route::resource('polizas', PolizaController::class);
    
    // Accidentes CRUD
    Route::resource('accidentes', AccidenteController::class);
    
    // Municipios CRUD
    Route::resource('municipios', MunicipioController::class);
    
    // Consultas especiales
    Route::get('/consultas/persona-poliza', [ConsultaController::class, 'personaPoliza'])->name('consultas.persona-poliza');
    Route::get('/consultas/exportar', [ConsultaController::class, 'exportarConsulta'])->name('consultas.exportar');


    Route::middleware(['auth'])->group(function () {
        Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
        Route::get('/consultas/estadisticas', [ConsultaController::class, 'estadisticas'])->name('consultas.estadisticas');
    });
});

require __DIR__.'/auth.php';
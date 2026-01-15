<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poliza extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_poliza',
        'persona_id',
        'vehiculo_id',
        'fecha_compra',
        'fecha_vencimiento',
        'monto_cobertura',
        'prima_mensual',
        'tipo_cobertura',
        'estado',
    ];

    protected $casts = [
        'fecha_compra' => 'date',
        'fecha_vencimiento' => 'date',
        'monto_cobertura' => 'decimal:2',
        'prima_mensual' => 'decimal:2',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function accidentes(): HasMany
    {
        return $this->hasMany(Accidente::class);
    }


}

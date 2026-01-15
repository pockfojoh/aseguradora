<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'marca',
        'modelo',
        'anio',
        'placa',
        'color',
        'numero_serie',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function polizas(): HasMany
    {
        return $this->hasMany(Poliza::class);
    }

    public function accidentes(): HasMany
    {
        return $this->hasMany(Accidente::class);
    }
}

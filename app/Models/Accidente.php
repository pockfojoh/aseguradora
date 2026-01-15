<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accidente extends Model
{
    use HasFactory;

    protected $fillable = [
        'poliza_id',
        'persona_id',
        'vehiculo_id',
        'municipio_id',
        'fecha_accidente',
        'hora_accidente',
        'descripcion',
        'gravedad',
        'monto_danios',
        'ubicacion',
    ];

    protected $casts = [
        'fecha_accidente' => 'date',
        'hora_accidente' => 'datetime:H:i:s',
        'monto_danios' => 'decimal:2',
    ];

    public function poliza(): BelongsTo
    {
        return $this->belongsTo(Poliza::class);
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }
}

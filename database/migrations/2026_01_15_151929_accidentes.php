<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accidentes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poliza_id')
                  ->constrained('polizas')
                  ->cascadeOnDelete();

            $table->foreignId('persona_id')
                  ->constrained('personas')
                  ->cascadeOnDelete();

            $table->foreignId('vehiculo_id')
                  ->constrained('vehiculos')
                  ->cascadeOnDelete();

            $table->foreignId('municipio_id')
                  ->constrained('municipios')
                  ->cascadeOnDelete();

            $table->date('fecha_accidente');
            $table->time('hora_accidente');

            $table->text('descripcion');

            $table->enum('gravedad', [
                'leve',
                'moderado',
                'grave',
            ]);

            $table->decimal('monto_danios', 10, 2);

            $table->string('ubicacion');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accidentes');
    }
};

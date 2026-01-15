<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();

            $table->string('numero_poliza')->unique();

            $table->foreignId('persona_id')
                  ->constrained('personas')
                  ->cascadeOnDelete();

            $table->foreignId('vehiculo_id')
                  ->constrained('vehiculos')
                  ->cascadeOnDelete();

            $table->date('fecha_compra');
            $table->date('fecha_vencimiento');

            $table->decimal('monto_cobertura', 10, 2);
            $table->decimal('prima_mensual', 8, 2);

            $table->enum('tipo_cobertura', [
                'basica',
                'intermedia',
                'completa',
            ]);

            $table->enum('estado', [
                'activa',
                'vencida',
                'cancelada',
            ])->default('activa');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polizas');
    }
};

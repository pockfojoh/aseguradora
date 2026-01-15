<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('persona_id')
                  ->constrained('personas')
                  ->cascadeOnDelete();

            $table->string('marca');
            $table->string('modelo');
            $table->integer('anio');
            $table->string('placa')->unique();
            $table->string('color');
            $table->string('numero_serie')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};

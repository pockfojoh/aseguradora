<?php

// database/migrations/2024_01_01_000001_create_personas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable();
            $table->text('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personas');
    }
};

// database/migrations/2024_01_01_000002_create_municipios_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('estado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipios');
    }
};

// database/migrations/2024_01_01_000003_create_vehiculos_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained()->onDelete('cascade');
            $table->string('marca', 100);
            $table->string('modelo', 100);
            $table->integer('anio');
            $table->string('placa', 20)->unique();
            $table->string('color', 50)->nullable();
            $table->string('numero_serie', 100)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
};

// database/migrations/2024_01_01_000004_create_polizas_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('polizas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_poliza', 50)->unique();
            $table->foreignId('persona_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained()->onDelete('cascade');
            $table->date('fecha_compra');
            $table->date('fecha_vencimiento');
            $table->decimal('monto_cobertura', 12, 2);
            $table->decimal('prima_mensual', 10, 2);
            $table->enum('tipo_cobertura', ['basica', 'intermedia', 'completa']);
            $table->enum('estado', ['activa', 'cancelada', 'vencida'])->default('activa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('polizas');
    }
};

// database/migrations/2024_01_01_000005_create_accidentes_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('accidentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poliza_id')->constrained()->onDelete('cascade');
            $table->foreignId('persona_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained()->onDelete('cascade');
            $table->foreignId('municipio_id')->constrained()->onDelete('cascade');
            $table->dateTime('fecha_accidente');
            $table->time('hora_accidente');
            $table->text('descripcion')->nullable();
            $table->enum('gravedad', ['leve', 'moderado', 'grave']);
            $table->decimal('monto_danios', 12, 2)->nullable();
            $table->text('ubicacion')->nullable();
            $table->timestamps();
            
            $table->index('hora_accidente');
            $table->index('fecha_accidente');
            $table->index('municipio_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accidentes');
    }
};
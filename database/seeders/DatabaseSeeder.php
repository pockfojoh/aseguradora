<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Municipio;
use App\Models\Vehiculo;
use App\Models\Poliza;
use App\Models\Accidente;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@aseguradora.com',
            'password' => Hash::make('password'),
        ]);

        // Crear municipios de Yucatán
        $municipios = [
            ['nombre' => 'Mérida', 'estado' => 'Yucatán'],
            ['nombre' => 'Valladolid', 'estado' => 'Yucatán'],
            ['nombre' => 'Tizimín', 'estado' => 'Yucatán'],
            ['nombre' => 'Progreso', 'estado' => 'Yucatán'],
            ['nombre' => 'Kanasín', 'estado' => 'Yucatán'],
            ['nombre' => 'Umán', 'estado' => 'Yucatán'],
            ['nombre' => 'Ticul', 'estado' => 'Yucatán'],
            ['nombre' => 'Motul', 'estado' => 'Yucatán'],
        ];

        foreach ($municipios as $municipio) {
            Municipio::create($municipio);
        }

        // Crear personas
        $personas = [
            [
                'nombre' => 'Juan',
                'apellido' => 'Pérez García',
                'email' => 'juan.perez@example.com',
                'telefono' => '9991234567',
                'direccion' => 'Calle 60 x 47, Centro, Mérida',
                'fecha_nacimiento' => '1985-05-15',
            ],
            [
                'nombre' => 'María',
                'apellido' => 'López Hernández',
                'email' => 'maria.lopez@example.com',
                'telefono' => '9992345678',
                'direccion' => 'Calle 21 x 30, García Ginerés, Mérida',
                'fecha_nacimiento' => '1990-08-22',
            ],
            [
                'nombre' => 'Carlos',
                'apellido' => 'Martínez Sosa',
                'email' => 'carlos.martinez@example.com',
                'telefono' => '9993456789',
                'direccion' => 'Calle 15 x 22, Itzimná, Mérida',
                'fecha_nacimiento' => '1982-12-10',
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Rodríguez Chan',
                'email' => 'ana.rodriguez@example.com',
                'telefono' => '9994567890',
                'direccion' => 'Av. Colón x 18, Centro, Mérida',
                'fecha_nacimiento' => '1995-03-18',
            ],
            [
                'nombre' => 'Luis',
                'apellido' => 'González Pech',
                'email' => 'luis.gonzalez@example.com',
                'telefono' => '9995678901',
                'direccion' => 'Calle 42 x 35, Fraccionamiento del Norte, Mérida',
                'fecha_nacimiento' => '1988-07-25',
            ],
        ];

        foreach ($personas as $personaData) {
            $persona = Persona::create($personaData);

            // Crear vehículo para cada persona
            $marcas = ['Toyota', 'Honda', 'Nissan', 'Mazda', 'Volkswagen'];
            $modelos = ['Corolla', 'Civic', 'Sentra', 'CX-5', 'Jetta'];
            $colores = ['Blanco', 'Negro', 'Gris', 'Azul', 'Rojo'];

            $vehiculo = Vehiculo::create([
                'persona_id' => $persona->id,
                'marca' => $marcas[array_rand($marcas)],
                'modelo' => $modelos[array_rand($modelos)],
                'anio' => rand(2015, 2024),
                'placa' => 'YUC-' . rand(100, 999) . '-' . chr(rand(65, 90)) . chr(rand(65, 90)),
                'color' => $colores[array_rand($colores)],
                'numero_serie' => strtoupper(bin2hex(random_bytes(8))),
            ]);

            // Crear póliza
            $fechaCompra = Carbon::now()->subMonths(rand(1, 24));
            $poliza = Poliza::create([
                'numero_poliza' => 'POL-' . date('Y') . '-' . str_pad($persona->id, 6, '0', STR_PAD_LEFT),
                'persona_id' => $persona->id,
                'vehiculo_id' => $vehiculo->id,
                'fecha_compra' => $fechaCompra,
                'fecha_vencimiento' => $fechaCompra->copy()->addYear(),
                'monto_cobertura' => rand(50000, 300000),
                'prima_mensual' => rand(500, 3000),
                'tipo_cobertura' => ['basica', 'intermedia', 'completa'][rand(0, 2)],
                'estado' => 'activa',
            ]);

            // Crear accidentes (algunos clientes tienen más que otros)
            $numAccidentes = rand(0, 5);
            for ($i = 0; $i < $numAccidentes; $i++) {
                $fechaAccidente = Carbon::now()->subDays(rand(1, 365));
                $hora = rand(0, 23);
                
                Accidente::create([
                    'poliza_id' => $poliza->id,
                    'persona_id' => $persona->id,
                    'vehiculo_id' => $vehiculo->id,
                    'municipio_id' => Municipio::inRandomOrder()->first()->id,
                    'fecha_accidente' => $fechaAccidente,
                    'hora_accidente' => sprintf('%02d:00:00', $hora),
                    'descripcion' => 'Accidente de tránsito en zona urbana',
                    'gravedad' => ['leve', 'moderado', 'grave'][rand(0, 2)],
                    'monto_danios' => rand(5000, 50000),
                    'ubicacion' => 'Calle ' . rand(1, 100) . ' x ' . rand(1, 100),
                ]);
            }
        }

        // Crear algunos accidentes concentrados en horas pico
        $horasPico = [7, 8, 14, 18, 19, 20]; // Horas con más tráfico
        for ($i = 0; $i < 30; $i++) {
            $poliza = Poliza::inRandomOrder()->first();
            $hora = $horasPico[array_rand($horasPico)];
            
            Accidente::create([
                'poliza_id' => $poliza->id,
                'persona_id' => $poliza->persona_id,
                'vehiculo_id' => $poliza->vehiculo_id,
                'municipio_id' => 1, // Mérida tiene más accidentes
                'fecha_accidente' => Carbon::now()->subDays(rand(1, 180)),
                'hora_accidente' => sprintf('%02d:%02d:00', $hora, rand(0, 59)),
                'descripcion' => 'Accidente en hora pico',
                'gravedad' => ['leve', 'moderado'][rand(0, 1)],
                'monto_danios' => rand(3000, 25000),
                'ubicacion' => 'Periférico de Mérida',
            ]);
        }

        $this->command->info('Base de datos poblada exitosamente!');
    }
}
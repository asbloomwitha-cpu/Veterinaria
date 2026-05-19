<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class DummyPacientesSeeder extends Seeder
{
    public function run()
    {
        $pacientes = [
            [
                'nombre' => 'Firulais',
                'especie' => 'Perro',
                'raza' => 'Mestizo',
                'edad' => 3,
                'nombre_propietario' => 'Juan Perez',
                'telefono_propietario' => '555-1234',
                'observaciones' => 'Vacunas al día. Muy juguetón.',
            ],
            [
                'nombre' => 'Michi',
                'especie' => 'Gato',
                'raza' => 'Siamés',
                'edad' => 2,
                'nombre_propietario' => 'Ana Garcia',
                'telefono_propietario' => '555-5678',
                'observaciones' => 'Alergia al pollo. Requiere dieta especial.',
            ],
            [
                'nombre' => 'Rex',
                'especie' => 'Perro',
                'raza' => 'Pastor Alemán',
                'edad' => 5,
                'nombre_propietario' => 'Carlos Lopez',
                'telefono_propietario' => '555-8765',
                'observaciones' => 'Problemas leves de cadera. Toma suplementos.',
            ],
            [
                'nombre' => 'Luna',
                'especie' => 'Perro',
                'raza' => 'Golden Retriever',
                'edad' => 1,
                'nombre_propietario' => 'Maria Fernandez',
                'telefono_propietario' => '555-4321',
                'observaciones' => 'Cachorro en entrenamiento. Primera visita.',
            ],
            [
                'nombre' => 'Nemo',
                'especie' => 'Pez',
                'raza' => 'Payaso',
                'edad' => 1,
                'nombre_propietario' => 'Pedro Ramirez',
                'telefono_propietario' => '555-0000',
                'observaciones' => 'Revisión de calidad de agua del acuario.',
            ],
        ];

        foreach ($pacientes as $paciente) {
            Paciente::create($paciente);
        }
    }
}

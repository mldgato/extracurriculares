<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create([
            'grade_name' => 'PreKinder',
            'grade_short_name' => 'PreKinder',
            'practices' => 0,
            'order' => 1
        ]);
        Grade::create([
            'grade_name' => 'Kinder',
            'grade_short_name' => 'Kinder',
            'practices' => 0,
            'order' => 2
        ]);
        Grade::create([
            'grade_name' => 'Preparatoria',
            'grade_short_name' => 'Preparatoria',
            'practices' => 0,
            'order' => 3
        ]);
        Grade::create([
            'grade_name' => 'Primero Primaria',
            'grade_short_name' => 'Primero Primaria',
            'practices' => 0,
            'order' => 4
        ]);
        Grade::create([
            'grade_name' => 'Segundo Primaria',
            'grade_short_name' => 'Segundo Primaria',
            'practices' => 0,
            'order' => 5
        ]);
        Grade::create([
            'grade_name' => 'Tercero primaria',
            'grade_short_name' => 'Tercero primaria',
            'practices' => 0,
            'order' => 6
        ]);
        Grade::create([
            'grade_name' => 'Cuarto Primaria',
            'grade_short_name' => 'Cuarto Primaria',
            'practices' => 0,
            'order' => 7
        ]);
        Grade::create([
            'grade_name' => 'Quinto Primaria',
            'grade_short_name' => 'Quinto Primaria',
            'practices' => 0,
            'order' => 8
        ]);
        Grade::create([
            'grade_name' => 'Sexto Primaria',
            'grade_short_name' => 'Sexto Primaria',
            'practices' => 0,
            'order' => 9
        ]);
        Grade::create([
            'grade_name' => 'Primero Básico',
            'grade_short_name' => 'Primero Básico',
            'practices' => 0,
            'order' => 10
        ]);
        Grade::create([
            'grade_name' => 'Segundo Básico',
            'grade_short_name' => 'Segundo Básico',
            'practices' => 0,
            'order' => 11
        ]);
        Grade::create([
            'grade_name' => 'Tercero Básico',
            'grade_short_name' => 'Tercero Básico',
            'practices' => 0,
            'order' => 12
        ]);
        Grade::create([
            'grade_name' => 'Cuarto Bachillerato en Ciencias y Letras',
            'grade_short_name' => 'Cuarto CL',
            'practices' => 0,
            'order' => 13
        ]);
        Grade::create([
            'grade_name' => 'Quinto Bachillerato en Ciencias y Letras',
            'grade_short_name' => 'Quinto CL',
            'practices' => 0,
            'order' => 14
        ]);
        Grade::create([
            'grade_name' => 'Cuarto Bachillerato en Ciencias y Letras con Orientación en Computación',
            'grade_short_name' => 'Cuarto BACO',
            'practices' => 0,
            'order' => 15
        ]);
        Grade::create([
            'grade_name' => 'Quinto Bachillerato en Ciencias y Letras con Orientación en Computación',
            'grade_short_name' => 'Quinto BACO',
            'practices' => 1,
            'order' => 16
        ]);
        Grade::create([
            'grade_name' => 'Cuarto Perito Contador con Orientación en Computación',
            'grade_short_name' => 'Cuarto PC',
            'practices' => 0,
            'order' => 17
        ]);
        Grade::create([
            'grade_name' => 'Quinto Perito Contador con Orientación en Computación',
            'grade_short_name' => 'Quinto PC',
            'practices' => 0,
            'order' => 18
        ]);
        Grade::create([
            'grade_name' => 'Sexto Perito Contador con Orientación en Computación',
            'grade_short_name' => 'Sexto PC',
            'practices' => 1,
            'order' => 19
        ]);
    }
}

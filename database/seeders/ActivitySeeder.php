<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::create([
            'activity' => 'Futsala'
        ]);
        Activity::create([
            'activity' => 'Baloncesto'
        ]);
        Activity::create([
            'activity' => 'Marimba'
        ]);
        Activity::create([
            'activity' => 'Vértice'
        ]);
        Activity::create([
            'activity' => 'Futbol 11'
        ]);
        Activity::create([
            'activity' => 'Banda Marcial'
        ]);
        Activity::create([
            'activity' => 'Banda Escolar'
        ]);
        Activity::create([
            'activity' => 'Béisbol'
        ]);
        Activity::create([
            'activity' => 'Gastadores'
        ]);
        Activity::create([
            'activity' => 'Escoltas/Banderas'
        ]);
        Activity::create([
            'activity' => 'Estandartes'
        ]);
    }
}

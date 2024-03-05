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
            'activity' => 'Futsala',
            'class' => 'primary'
        ]);
        Activity::create([
            'activity' => 'Baloncesto',
            'class' => 'danger'
        ]);
        Activity::create([
            'activity' => 'Marimba',
            'class' => 'info'
        ]);
        Activity::create([
            'activity' => 'Vértice',
            'class' => 'warning'
        ]);
        Activity::create([
            'activity' => 'Futbol 11',
            'class' => 'success'
        ]);
        Activity::create([
            'activity' => 'Banda Marcial',
            'class' => 'indigo'
        ]);
        Activity::create([
            'activity' => 'Banda Escolar',
            'class' => 'purple'
        ]);
        Activity::create([
            'activity' => 'Béisbol',
            'class' => 'orange'
        ]);
        Activity::create([
            'activity' => 'Gastadores',
            'class' => 'primary'
        ]);
        Activity::create([
            'activity' => 'Escoltas/Banderas',
            'class' => 'danger'
        ]);
        Activity::create([
            'activity' => 'Estandartes',
            'class' => 'info'
        ]);
    }
}

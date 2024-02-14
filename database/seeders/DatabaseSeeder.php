<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Manuel Lisandro',
             'surname' => 'Dardón López',
             'email' => 'mdardon@colegiodeinfantes.edu.gt',
            'password' => 'Alejandro31$',
        ]);

        $this->call(CycleSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ClassroomSeeder::class);
    }
}

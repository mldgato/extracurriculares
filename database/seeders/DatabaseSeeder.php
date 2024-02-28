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
        $this->call(ActivitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CycleSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(StudentSeeder::class);
    }
}

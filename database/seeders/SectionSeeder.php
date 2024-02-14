<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([
            'section_name' => 'A',
            'order' => 1
        ]);
        Section::create([
            'section_name' => 'B',
            'order' => 2
        ]);
        Section::create([
            'section_name' => 'C',
            'order' => 3
        ]);
        Section::create([
            'section_name' => 'D',
            'order' => 4
        ]);
    }
}

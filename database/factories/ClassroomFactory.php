<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cycle;
use App\Models\Level;
use App\Models\Grade;
use App\Models\Section;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cycle_id' => Cycle::all()->random()->id,
            'level_id' => Level::all()->random()->id,
            'grade_id' => Grade::all()->random()->id,
            'section_id' => Section::all()->random()->id
        ];
    }
}

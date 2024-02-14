<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade_name' => $this->faker->name(),
            'grade_short_name' => $this->faker->words(3, true),
            'practices' => $this->faker->randomElement([0, 1]),
            'order' => $this->faker->numberBetween(1, 100)
        ];
    }
}

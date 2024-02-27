<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codschool' => $this->faker->numberBetween(20211001, 20224999),
            'firstname' => $this->faker->firstName().' '.$this->faker->firstName(),
            'lastname' => $this->faker->lastName().' ' .$this->faker->lastName(),
        ];
    }
}

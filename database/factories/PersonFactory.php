<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tussenvoegsel = rand(0, 1) ? $this->faker->word() : '';

        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $tussenvoegsel,
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->date(),
            'passport_details' => $this->faker->optional()->text,
            'is_active' => $this->faker->boolean,
            'note' => $this->faker->optional()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
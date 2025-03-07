<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Person;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a list of available person IDs
        $personIds = Person::pluck('id')->toArray();
        
        // Ensure person_id is unique
        $personId = $this->faker->unique()->randomElement($personIds);

        return [
            'person_id' => $personId,
            'role_id' => Rol::inRandomOrder()->first()->id,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'is_logged_in' => $this->faker->boolean,
            'logged_in_at' => $this->faker->optional()->dateTime,
            'logged_out_at' => now(),
            'is_active' => $this->faker->boolean,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'comments' => $this->faker->optional()->sentence,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

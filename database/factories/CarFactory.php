<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), 
            'make' => $this->faker->randomElement(['Toyota', 'BMW', 'Audi', 'Ford', 'Tesla', 'Mercedes']),
            'model' => $this->faker->word(),
            'year' => $this->faker->numberBetween(2000, 2024),
            'transmission' => $this->faker->randomElement(['Automatic', 'Manual']),
            'capacity' => $this->faker->numberBetween(2, 7),
            'price_per_day' => $this->faker->randomFloat(2, 30, 300),
            'location' => $this->faker->city(),
        ];
    }
}

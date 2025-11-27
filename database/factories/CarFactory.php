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
        $images = [
            'https://www.autoshippers.co.uk/blog/wp-content/uploads/bugatti-centodieci.jpg',
            'https://hips.hearstapps.com/hmg-prod/images/2022-chevrolet-corvette-z06-1607016574.jpg?crop=0.800xw:0.601xh;0.150xw,0.318xh&resize=1200:*',
            'https://i.blogs.es/28e39b/cars/500_333.webp',
        ];

        return [
            'user_id' => User::factory(), 
            'make' => $this->faker->randomElement(['Toyota', 'BMW', 'Audi', 'Ford', 'Tesla', 'Mercedes']),
            'model' => $this->faker->word(),
            'year' => $this->faker->numberBetween(2000, 2024),
            'transmission' => $this->faker->randomElement(['Automatic', 'Manual']),
            'capacity' => $this->faker->numberBetween(2, 7),
            'price_per_day' => $this->faker->randomFloat(2, 30, 300),
            'location' => $this->faker->city(),
            'image' => $this->faker->randomElement($images),

        ];
    }
}

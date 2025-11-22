<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Car::factory(10)->create();
        Reservation::factory(20)->create();
        Review::factory(20)->create();
    }
}

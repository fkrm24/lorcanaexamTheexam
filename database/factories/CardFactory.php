<?php

namespace Database\Factories;

use App\Models\Set;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "api_id" => Str::uuid()->toString(),
            "set_id" => Set::factory(),
            "name" => fake()->word(),
            "number" => fake()->numberBetween(1, 500),
            "rarity" => fake()->randomElement([
                "Uncommon",
                "Rare",
                "Super Rare",
                "Common", // Ajoute si besoin
                "Legendary" // Ajoute si besoin
            ]),
            "image" => fake()->imageUrl(),
        ];
    }
}


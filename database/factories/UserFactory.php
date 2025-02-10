<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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

    public function configure()
{
    return $this->afterCreating(function (User $user) {
        // Récupérer les cartes existantes
        $existingCards = Card::all()->pluck('id')->toArray();

        // Attacher entre 1 et 5 cartes existantes à l'utilisateur dans la table pivot 'user_cards'
        $user->cards()->attach(
            array_rand(array_flip($existingCards), rand(1, 5))
        );

        // Attacher entre 1 et 5 cartes existantes à la wishlist de l'utilisateur dans la table pivot 'wishlist'
        $user->wishlist()->attach(
            array_rand(array_flip($existingCards), rand(1, 5))
        );
    });
}
}

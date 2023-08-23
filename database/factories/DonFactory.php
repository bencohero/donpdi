<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Don>
 */
class DonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'montant' => fake()->numberBetween(100, 1000000),
            'numeroTransaction' => fake()->unique()->numerify('LGD.####.####.C###'),
            'token' => Str::random(20),
            'status' => fake()->randomElement(['pending', 'completed','canceled', 'failed']),
            'id_donateur' => User::factory(),
        ];
    }
}
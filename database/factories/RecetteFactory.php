<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recette>
 */
class RecetteFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $users_id = User::all()->pluck('id');
        return [
            'nom' => $this->faker->sentence(5, true),
            'description' => $this->faker->paragraph,
            'categorie' => $this->faker->randomElement(['Entrée', 'Plat', 'Dessert']),
            'visuel' => 'recette.jpg',
            'nb_personnes' => $this->faker->numberBetween(1, 10),
            'temps_preparation' => $this->faker->numberBetween(10, 120),
            'cout' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->randomElement($users_id),
            // 'user_id' => User::all()->random()->id,
        ];
    }
}

<?php

namespace Database\Factories;

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
        return [
            'nom' => $this->faker->sentence(5, true),
            'description' => $this->faker->paragraph,
            'categorie' => $this->faker->randomElement(['Entrée', 'Plat', 'Dessert']),
            'visuel' => 'recette.jpg',
            'nb_personnes' => $this->faker->numberBetween(1, 10),
            'temps_preparation' => $this->faker->numberBetween(10, 120),
            'cout' => $this->faker->numberBetween(1, 5),
        ];
    }
}

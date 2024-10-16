<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tache>
 */
class TacheFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $createAt = $this->faker->dateTimeInInterval('-6 months', '+ 180 days');
        return [
            'expiration' => $this->faker->dateTimeBetween($createAt, '+1 month'),
            'categorie' => $this->faker->randomElement(['A Faire', 'En cours', 'Urgent']),
            'effectuee' => $this->faker->boolean(50),
            'description' => $this->faker->sentence(6, true),
            'created_at' => $createAt,
            'updated_at' => $this->faker->dateTimeInInterval(
                $createAt, $createAt->diff(new DateTime('now'))->format("%R%a days"),
            ),
        ];
    }
}

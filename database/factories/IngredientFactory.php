<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'nature' => $this->faker->word,
            'visuel' => 'ingredient.png',
        ];
    }
}

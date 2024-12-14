<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recette;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();
        $ingredients = Ingredient::factory()->count(10)->create();

        Recette::all()->each(function ($recette) use ($faker, $ingredients) {
            $recette->ingredients()->attach(
                $ingredients->random(3)->pluck('id')->toArray(),
                [
                    'quantite' => '100g',
                    'observation' => $faker->sentence
                ]
            );
        });
    }
}

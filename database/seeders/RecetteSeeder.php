<?php

namespace Database\Seeders;

use App\Models\Recette;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users_id = User::all()->pluck('id');
        $recettes = Recette::factory()->count(10)->create();
        $recettes->each(function ($recette) use ($users_id) {
            $recette->user_id = $users_id->random();
            $recette->save();
        });
    }

}

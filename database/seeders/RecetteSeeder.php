<?php

namespace Database\Seeders;

use App\Models\Recette;
use Illuminate\Database\Seeder;

class RecetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Recette::factory()->count(10)->create();
    }
}

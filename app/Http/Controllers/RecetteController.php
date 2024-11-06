<?php

namespace App\Http\Controllers;

use App\Models\Recette;

class RecetteController extends Controller
{
    public function index()
    {
        $recettes = Recette::all();
        return view('recettes.index', ['recettes' => $recettes]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cat = $request->input('cat', 'All');
        if ($cat != 'All') {
            $recettes = Recette::where('categorie', $cat)->get();
        } else {
            $recettes = Recette::all();
        }
        $categories = Recette::distinct('categorie')->pluck('categorie');
        return view('recettes.index', ['recettes' => $recettes, 'cat' => $cat, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recettes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'visuel' => 'required',
            'nb_personnes' => 'required',
            'temps_preparation' => 'required',
            'cout' => 'required'
        ]);

    $recette = new Recette();

    $recette->nom = $request->input('nom');
    $recette->description = $request->input('description');
    $recette->categorie = $request->input('categorie');
    $recette->visuel = $request->input('visuel');
    $recette->nb_personnes = $request->input('nb_personnes');
    $recette->temps_preparation = $request->input('temps_preparation');
    $recette->cout = $request->input('cout');

    $recette->save();

    return redirect()->route('recettes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recette = Recette::find($id);
        $action = '';
        return view('recettes.show', ['recette' => $recette, 'action' => $action]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recette = Recette::find($id);
        return view('recettes.edit', ['recette' => $recette]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recette = Recette::find($id);

        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'visuel' => 'required',
            'nb_personnes' => 'required',
            'temps_preparation' => 'required',
            'cout' => 'required'
        ]);

        $recette->nom = $request->input('nom');
        $recette->description = $request->input('description');
        $recette->categorie = $request->input('categorie');
        $recette->visuel = $request->input('visuel');
        $recette->nb_personnes = $request->input('nb_personnes');
        $recette->temps_preparation = $request->input('temps_preparation');
        $recette->cout = $request->input('cout');

        $recette->save();

        return redirect()->route('recettes.show', ['id' => $recette->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recette = Recette::find($id);
        $recette->delete();

        return redirect()->route('recettes.index');
    }


}

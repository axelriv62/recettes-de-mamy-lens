<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index(Request $request)
//    {
//        $cat = $request->input('cat', 'All');
//        if ($cat != 'All') {
//            $recettes = Recette::where('categorie', $cat)->get();
//        } else {
//            $recettes = Recette::all();
//        }
//        $categories = Recette::distinct('categorie')->pluck('categorie');
//        return view('recettes.index', ['recettes' => $recettes, 'cat' => $cat, 'categories' => $categories]);
//    }

    public function index(Request $request): View {
        $cat = $request->input('cat', null);
        $value = $request->cookie('cat', null);

        if (!isset($cat)) {
            if (!isset($value)) {
                $recettes = Recette::all();
                $cat = 'All';
                Cookie::expire('cat');
            } else {
                $recettes = Recette::where('categorie', $value)->get();
                $cat = $value;
                Cookie::queue('cat', $cat, 10);            }
        } else {
            if ($cat == 'All') {
                $recettes = Recette::all();
                Cookie::expire('cat');
            } else {
                $recettes = Recette::where('categorie', $cat)->get();
                Cookie::queue('cat', $cat, 10);
            }
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

    return redirect()->route('recettes.index')
        ->with('type', 'primary')
        ->with('message', 'Recette ajoutée avec succès');
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

        return redirect()->route('recettes.show', ['recette' => $recette->id]);
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

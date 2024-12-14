<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
                Cookie::queue('cat', $cat, 10);
            }
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
//    public function store(Request $request)
//    {
//        $request->validate([
//            'nom' => 'required',
//            'description' => 'required',
//            'categorie' => 'required',
//            'visuel' => 'required',
//            'nb_personnes' => 'required',
//            'temps_preparation' => 'required',
//            'cout' => 'required'
//        ]);
//
//    $recette = new Recette();
//
//    $recette->nom = $request->input('nom');
//    $recette->description = $request->input('description');
//    $recette->categorie = $request->input('categorie');
//    $recette->visuel = $request->input('visuel');
//    $recette->nb_personnes = $request->input('nb_personnes');
//    $recette->temps_preparation = $request->input('temps_preparation');
//    $recette->cout = $request->input('cout');
//
//    $recette->save();
//
//    return redirect()->route('recettes.index')
//        ->with('type', 'primary')
//        ->with('message', 'Recette ajoutée avec succès');
//    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'nb_personnes' => 'required',
            'temps_preparation' => 'required',
            'cout' => 'required',
            'visuel' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recette = new Recette();
        $recette->nom = $request->input('nom');
        $recette->description = $request->input('description');
        $recette->categorie = $request->input('categorie');
        $recette->nb_personnes = $request->input('nb_personnes');
        $recette->temps_preparation = $request->input('temps_preparation');
        $recette->cout = $request->input('cout');
        $recette->user_id = $request->user()->id;

        if ($request->hasFile('visuel') && $request->file('visuel')->isValid()) {
            $file = $request->file('visuel');
            $nom = 'image_' . time() . '.' . $file->extension();
            $file->storeAs('images', $nom);
            $recette->visuel = 'images/' . $nom;
        } else {
            $recette->visuel = 'images/recette.jpg';
        }

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
        $user = $request->user();
        $recette = Recette::find($id);

        if ($user->cant('update', $recette)) {
            return redirect()->route('recettes.show', ['recette' => $recette->id])
                ->with('type', 'warning')
                ->with('message', 'Impossible de modifier la recette');
        }

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

        if (Gate::denies('delete', $recette)) {
            return redirect()->route('recettes.show', ['recette' => $recette->id])
                ->with('type', 'error')
                ->with('msg', 'Impossible de supprimer la tâche');
        }

        $recette->delete();

        return redirect()->route('recettes.index')
            ->with('type', 'primary')
            ->with('msg', 'Recette supprimée avec succès');
    }

    public function upload(Request $request, $id) {
        $recette = recette::findOrFail($id);
        if ($request->hasFile('visuel') && $request->file('visuel')->isValid()) {
            $file = $request->file('visuel');
        } else {
            $msg = "Aucun fichier téléchargé";
            return redirect()->route('recettes.show', [$recette->id])
                ->with('type', 'primary')
                ->with('message', 'Recette non modifiée ('. $msg . ')');
        }
        $nom = 'image';
        $now = time();
        $nom = sprintf("%s_%d.%s", $nom, $now, $file->extension());

        $file->storeAs('images/', $nom);
        if (isset($recette->visuel)) {
            Log::info("Image supprimée : ". $recette->visuel);
            Storage::delete($recette->visuel);
        }
        $recette->visuel = 'images/'.$nom;
        $recette->save();
        //$file->store('docs');
        return redirect()->route('recettes.show', [$recette->id])
            ->with('type', 'primary')
            ->with('message', 'Tâche modifiée avec succès');
    }



}

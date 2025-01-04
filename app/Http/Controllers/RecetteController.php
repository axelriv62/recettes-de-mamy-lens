<?php

namespace App\Http\Controllers;

use App\Repositories\IIngredientRepository;
use App\Repositories\IngredientRepository;
use App\Repositories\IRecetteRepository;
use App\Repositories\RecetteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class RecetteController extends Controller
{

    private RecetteRepository $recetteRepository;
    private IngredientRepository $ingredientRepository;

    public function __construct(RecetteRepository $recetteRepository, IngredientRepository $ingredientRepository)
    {
        $this->recetteRepository = $recetteRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View {
        $cat = $request->input('cat', 'All');
        $nb_personnes = $request->input('nb_personnes', 'All');
        $cout = $request->input('cout', 'All');
        $temps_preparation = $request->input('temps_preparation', 'All');
        $random = $request->input('random', false);
        $tri_par_notes = $request->input('tri_par_notes', false);

        if ($random) {
            $recettes = $this->recetteRepository->random(5);
        } else {
            $cookieCat = $request->cookie('cat', null);
            if ($cat === 'All' && $cookieCat !== null) {
                $cat = 'All';
            } else {
                Cookie::queue('cat', $cat, 10);
            }
            if ($tri_par_notes) {
                $recettes = $this->recetteRepository->all($cat, $nb_personnes, $cout, $temps_preparation)->sortByDesc('note');
            } else {
                $recettes = $this->recetteRepository->all($cat, $nb_personnes, $cout, $temps_preparation);
            }
        }
        $categories = $this->recetteRepository->categories();

        return view('recettes.index', [
            'recettes' => $recettes,
            'cat' => $cat,
            'nb_personnes' => $nb_personnes,
            'cout' => $cout,
            'temps_preparation' => $temps_preparation,
            'categories' => $categories,
            'tri_par_notes' => $tri_par_notes,
        ]);
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
            'nb_personnes' => 'required',
            'temps_preparation' => 'required',
            'cout' => 'required',
            'visuel' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ingredient = $this->recetteRepository->create($request->only(['nom', 'description', 'categorie', 'nb_personnes', 'temps_preparation', 'cout', 'visuel']));

        return redirect()->route('recettes.index')
            ->with('type', 'primary')
            ->with('message', 'Recette ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $action = request()->input('action', 'show');
        $recette = $this->recetteRepository->find($id);
        $recette->load('ingredients');
        $allIngredients = $this->ingredientRepository->all();
        return view('recettes.show', ['recette' => $recette, 'action' => $action], ['allIngredients' => $allIngredients]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $recette = $this->recetteRepository->find($id);
        if (request()->user()->cannot('update', $recette)) {
            return redirect()->route('recettes.index')
                ->with('type', 'danger')
                ->with('message', "Vous n'avez pas les droits pour modifier cette recette");
        }

        return view('recettes.edit', ['recette' => $recette], ['allingredients'], ['titre' => "Modification d'une recette"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $recette = $this->recetteRepository->find($id);

        if (request()->user()->cannot('update', $recette)) {
            return redirect()->route('recettes.index')
                ->with('type', 'danger')
                ->with('message', "Vous n'avez pas les droits pour modifier cette recette");
        }

        request()->validate([
            'nom' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'nb_personnes' => 'required',
            'temps_preparation' => 'required',
            'cout' => 'required',
            'visuel' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $this->recetteRepository->update($id, request()->only(['nom', 'description', 'categorie', 'nb_personnes', 'temps_preparation', 'cout', 'visuel']));

        return redirect()->route('recettes.index')
            ->with('type', 'primary')
            ->with('message', 'Recette modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $val = request("delete", "annule");
        if ($val == "delete") {
            $recette = $this->recetteRepository->find($id);
            if (request()->user()->cannot('delete', $recette)) {
                return redirect()->route('recettes.index')
                    ->with('type', 'danger')
                    ->with('message', "Vous n'avez pas les droits pour supprimer cette recette");
            }
            $this->recetteRepository->delete($id);
            return redirect()->route('recettes.index')
                ->with('type', 'primary')
                ->with('message', 'Recette supprimée avec succès');
        } else {
            return redirect()->route('recettes.index')
                ->with('type', 'danger')
                ->with('message', 'Suppression annulée');
        }
    }

    public function upload(int $id)
    {
        $msg = '';
        $type = 'primary';
        if (request()->hasFile('visuel') && request()->file('visuel')->isValid()) {
            $file = request()->file('visuel');
            $recette = $this->recetteRepository->uploadImage($file, $id);
            $msg = 'Image téléchargée avec succès';
        } else {
            if (request()->hasFile('image')) {
                $msg = 'Fichier invalide';
            } else {
                $msg = 'Aucun fichier téléchargé';
            }
            $type = 'error';
        }
        return redirect()->route('recettes.show', ['id' => $id])
            ->with('type', $type)
            ->with('message', $msg);
    }


    // J'ai eu des soucis avec l'implémentation des fonctionnalités d'ajout et de suppression d'ingrédients.
    // C'est pour cela que ces fonctionnalités ne sont pas disponibles dans l'application.
    public function addIngredient(Request $request, $id)
    {
        $recette = $this->recetteRepository->find($id);
        $ingredientId = $request->input('ingredient_id');
        $quantite = $request->input('quantite');
        $observation = $request->input('observation');

        $recette->ingredients()->attach($ingredientId, ['quantite' => $quantite, 'observation' => $observation]);

        return redirect()->route('recettes.show', $id)
            ->with('type', 'primary')
            ->with('message', 'Ingrédient ajouté avec succès');
    }

    public function removeIngredient($recetteId, $ingredientId)
    {
        $recette = $this->recetteRepository->find($recetteId);
        $recette->ingredients()->detach($ingredientId);

        return redirect()->route('recettes.show', $recetteId)
            ->with('type', 'primary')
            ->with('message', 'Ingrédient retiré avec succès');
    }

}

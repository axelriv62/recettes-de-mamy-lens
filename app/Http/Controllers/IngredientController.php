<?php

namespace App\Http\Controllers;

use App\Repositories\IIngredientRepository;
use Illuminate\Support\Facades\Cookie;

class IngredientController extends Controller
{
    private IIngredientRepository $ingredientRepository;

    public function __construct(IIngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = $this->ingredientRepository->all();
        return view('ingredients.index', ['ingredients' => $ingredients, 'titre' => 'Liste des ingrédients']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create', ['titre' => "Création d'un ingrédient"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        request()->validate([
            'nom' => 'required',
            'nature' => 'required',
            'visuel' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $ingredient = $this->ingredientRepository->create(request()->only(['nom', 'nature', 'visuel']));

        return redirect()->route('ingredients.index')
            ->with('type', 'primary')
            ->with('message', 'Ingrédient ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $action = request()->input('action', 'show');
        $ingredient = $this->ingredientRepository->find($id);
        return view('ingredients.show', ['ingredient' => $ingredient, 'action' => $action, 'titre' => "Détail d'un ingredient"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $ingredient = $this->ingredientRepository->find($id);

        if (request()->user()->cannot('update', $ingredient)) {
            return redirect()->route('ingredients.index')
                ->with('type', 'danger')
                ->with('message', "Vous n'avez pas les droits pour modifier cet ingrédient");
        }

        return view('ingredients.edit', ['ingredient' => $ingredient, 'titre' => "Modification d'un ingrédient"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id)
    {
        $ingredient = $this->ingredientRepository->find($id);

        if (request()->user()->cannot('update', $ingredient)) {
            return redirect()->route('ingredients.index')
                ->with('type', 'danger')
                ->with('message', "Vous n'avez pas les droits pour modifier cet ingrédient");
        }

        request()->validate([
            'nom' => 'required',
            'nature' => 'required',
            'visuel' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->ingredientRepository->update($id, request()->only(['nom', 'nature', 'visuel']));

        return redirect()->route('ingredients.index')
            ->with('type', 'primary')
            ->with('message', 'Ingrédient modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $val = request("delete", "annule");
        if ($val == "delete") {
            $ingredient = $this->ingredientRepository->find($id);
            if (request()->user()->cannot('delete', $ingredient)) {
                return redirect()->route('ingredients.index')
                    ->with('type', 'danger')
                    ->with('message', "Vous n'avez pas les droits pour supprimer cet ingrédient");
            }
            $this->ingredientRepository->delete($id);
            return redirect()->route('ingredients.index')
                ->with('type', 'primary')
                ->with('message', 'Ingrédient supprimé avec succès');
        } else {
            return redirect()->route('ingredients.index')
                ->with('type', 'danger')
                ->with('message', 'Suppression annulée');
        }
    }

    public function upload(int $id)
    {
        $msg = '';
        $type = 'primary';
        $ingredient = $this->ingredientRepository->find($id);
        if (request()->hasFile('visuel') && request()->file('visuel')->isValid()) {
            $file = request()->file('visuel');
            $ingredient = $this->ingredientRepository->uploadImage($file, $id);
            $msg = 'Image téléchargée avec succès';
        } else {
            if (!request()->hasFile('visuel')) {
                $msg = 'Aucun fichier téléchargé';
            } else {
                $msg = 'Fichier non valide';
            }
            $type = 'error';
        }
        return redirect()->route('ingredients.show', ['id' => $id])
            ->with('type', $type)
            ->with('message', $msg);
    }
}

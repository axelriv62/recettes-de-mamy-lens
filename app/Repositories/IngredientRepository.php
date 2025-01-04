<?php

namespace App\Repositories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class IngredientRepository implements IIngredientRepository
{

    public function all(string $cat = null): Collection
    {
        $query = Ingredient::query();
        if ($cat) {
            $query = $query->where('categorie', $cat);
        }
        return $query->get();
    }

    public function find(int $id): Ingredient
    {
        return Ingredient::findOrFail($id);
    }

    public function create(array $data): Ingredient
    {
        return Ingredient::create($data);
    }

    public function update(int $id, array $data): Ingredient
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($data);
        return $ingredient;
    }

    public function delete(int $id): void
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
    }

    public function categories(): array
    {
        return Ingredient::distinct('categorie')->pluck('categorie')->toArray();
    }

    public function uploadImage(UploadedFile $file, int $id): Ingredient
    {
        $ingredient = Ingredient::findOrFail($id);

        $nom = $ingredient->nom;
        $now = time();
        $nom = sprintf('%s_%d.%s', $nom, $now, $file->extension());

        $file->storeAs('images/ingredients', $nom);
        if (isset($ingredient->visuel) && $ingredient->visuel != "images/no-image.svg") {
            Storage::delete($ingredient->visuel);
        }
        $ingredient->visuel = 'ingredients/' . $nom;
        $ingredient->save();

        return $ingredient;
    }
}

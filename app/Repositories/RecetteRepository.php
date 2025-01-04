<?php

namespace App\Repositories;

use App\Models\Recette;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RecetteRepository implements IRecetteRepository
{

    public function all(string $cat = '', string $nb_personnes = '', string $cout = '', string $temps_preparation = ''): Collection
    {
        $query = Recette::query();

        if ($cat !== '' && $cat !== 'All') {
            $query->where('categorie', $cat);
        }
        if ($nb_personnes !== '' && $nb_personnes !== 'All') {
            if ($nb_personnes == '1-2') {
                $query->whereBetween('nb_personnes', [1, 2]);
            } elseif ($nb_personnes == '3-4') {
                $query->whereBetween('nb_personnes', [3, 4]);
            } else {
                $query->where('nb_personnes', '>=', 5);
            }
        }
        if ($cout !== '' && $cout !== 'All') {
            $query->where('cout', $cout);
        }
        if ($temps_preparation !== '' && $temps_preparation !== 'All') {
            if ($temps_preparation == '0-30') {
                $query->whereBetween('temps_preparation', [0, 30]);
            } elseif ($temps_preparation == '31-60') {
                $query->whereBetween('temps_preparation', [31, 60]);
            } else {
                $query->where('temps_preparation', '>', 60);
            }
        }

        return $query->get();
    }

    public function find(int $id): Recette
    {
        return Recette::findOrFail($id);
    }

    public function create(array $data): Recette
    {
        return Recette::create($data);
    }

    public function update(int $id, array $data): Recette
    {
       $recette = Recette::findOrFail($id);
       $recette->update($data);
       return $recette;
    }

    public function delete(int $id): void
    {
        $recette = Recette::findOrFail($id);
        $recette->delete();
    }

    public function categories(): array
    {
        return Recette::distinct('categorie')->pluck('categorie')->toArray();
    }

    public function uploadImage(UploadedFile $file, int $id): Recette
    {
        $recette = Recette::findOrFail($id);

        $nom = $recette->nom;
        $now = time();
        $nom = sprintf('%s_%d.%s', $nom, $now, $file->extension());

        $file->storeAs('images/recettes', $nom);
        if (isset($recette->visuel) && $recette->visuel != "public/images/recettes/no-image.svg") {
            Storage::delete($recette->visuel);
        }
        $recette->visuel = 'recettes/' . $nom;
        $recette->save();
        return $recette;
    }

    public function random(int $count): Collection {
        return Recette::inRandomOrder()->limit($count)->get();
    }
}

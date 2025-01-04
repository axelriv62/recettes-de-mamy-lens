<?php

namespace App\Repositories;

use App\Models\Recette;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


interface IRecetteRepository
{

    public function all(string $cat = '', string $nb_personnes = '', string $cout = '', string $temps_preparation = ''): Collection;

    public function find(int $id): Recette;

    public function create(array $data): Recette;

    public function update(int $id, array $data): Recette;

    public function delete(int $id): void;

    public function categories(): array;

    public function uploadImage(UploadedFile $file, int $id): Recette;

}

<?php

namespace App\Repositories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

interface IIngredientRepository
{

    public function all(string $cat): Collection;

    public function find(int $id): Ingredient;

    public function create(array $data): Ingredient;

    public function update(int $id, array $data): Ingredient;

    public function delete(int $id): void;

    public function categories(): array;

    public function uploadImage(UploadedFile $file, int $id): Ingredient;

}

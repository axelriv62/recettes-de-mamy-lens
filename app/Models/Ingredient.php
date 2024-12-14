<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'nature', 'visuel'];

    public function recettes()
    {
        return $this->belongsToMany(Recette::class, 'compose')
            ->as('composition')
            ->withPivot('quantite', 'observation')
            ->withTimestamps();
    }
}

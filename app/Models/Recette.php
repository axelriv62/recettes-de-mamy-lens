<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model {
    use HasFactory;

    /*
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nom',
        'description',
        'categorie',
        'visuel',
        'nb_personnes',
        'temps_preparation',
        'cout',
        'note',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class, 'compose')
            ->as('composition')
            ->withPivot('quantite', 'observation')
            ->withTimestamps();
    }
}

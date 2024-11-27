<?php

use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('statiques.accueil', ['titre' => 'Accueil']);
})->name('accueil');


// Route::get('/recettes', [RecetteController::class,'index'])->name('recettes.index');

Route::get('/presentation', function () {
    return view('statiques.presentation');
})->name('presentation');

Route::get('/contact', function () {
    return view('statiques.contact');
})->name('contact');

#Route::resource('/recettes', 'RecetteController');
Route::resource('/recettes', RecetteController::class);

Route::post('/recettes/{id}/upload', [RecetteController::class, 'upload'])->name('recettes.upload');

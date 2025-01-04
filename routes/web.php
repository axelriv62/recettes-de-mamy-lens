<?php

use App\Http\Controllers\RecetteController;
use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('statiques.accueil', ['titre' => 'Accueil']);
})->name('accueil');

Route::get('/presentation', function () {
    return view('statiques.presentation');
})->name('presentation');

Route::get('/contact', function () {
    return view('statiques.contact');
})->name('contact');

Route::get('/home', function () {
    return view('home', ['titre' => 'Gestion des recettes de MamyLens']);
})->middleware(['auth', 'verified'])->name('home');

Route::get('/accueil', function () {
    return view('statiques.accueil', ['titre' => 'Accueil']);
})->name('accueil');

Route::resource('recettes', RecetteController::class);
Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index')->middleware('auth');
Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create')->middleware('auth');
Route::post('/recettes/{id}', [RecetteController::class, 'show'])->name('recettes.show')->middleware('auth');
Route::get('/recettes/{id}/edit', [RecetteController::class, 'edit'])->name('recettes.edit')->middleware('auth');
Route::post('/recettes/{id}/update', [RecetteController::class, 'update'])->name('recettes.update')->middleware('auth');
Route::get('/recettes/{id}/delete', [RecetteController::class, 'delete'])->name('recettes.delete')->middleware('auth');
Route::post('/recettes/{id}/upload', [RecetteController::class, 'upload'])->name('recettes.upload')->middleware('auth');

Route::resource('ingredients', IngredientController::class);
Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index')->middleware('auth');
Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create')->middleware('auth');
Route::post('/ingredients/{id}', [IngredientController::class, 'show'])->name('ingredients.show')->middleware('auth');
Route::get('/ingredients/{id}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit')->middleware('auth');
Route::post('/ingredients/{id}/update', [IngredientController::class, 'update'])->name('ingredients.update')->middleware('auth');
Route::post('/ingredients/{id}/delete', [IngredientController::class, 'delete'])->name('ingredients.delete')->middleware('auth');
Route::post('/ingredients/{id}/upload', [IngredientController::class, 'upload'])->name('ingredients.upload')->middleware('auth');

Route::post('/recettes/{id}/add-ingredient', [RecetteController::class, 'addIngredient'])->name('recettes.addIngredient')->middleware('auth');
Route::post('/recettes/{recetteId}/remove-ingredient/{ingredientId}', [RecetteController::class, 'removeIngredient'])->name('recettes.removeIngredient')->middleware('auth');

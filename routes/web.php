<?php

use App\Http\Controllers\RecetteController;
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

Route::resource('recettes', RecetteController::class);
Route::post('recettes/{id}', [RecetteController::class, 'show']);

Route::post('/recettes/{id}/upload', [RecetteController::class, 'upload'])->name('recettes.upload');

// Empecher l'accès et la manipulation des recettes par des utilisateurs non authentifiés
Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index')->middleware('auth');
Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create')->middleware('auth');
Route::get('/recettes/{id}/edit', [RecetteController::class, 'edit'])->name('recettes.edit')->middleware('auth');
Route::get('/recettes/{id}/delete', [RecetteController::class, 'delete'])->name('recettes.delete')->middleware('auth');

Route::get('/home', function () {
    return view('home', ['titre' => 'Gestion des recettes de MamyLens']);
})->middleware(['auth', 'verified'])->name('home');

Route::get('/accueil', function () {
    return view('statiques.accueil', ['titre' => 'Accueil']);
})->name('accueil');

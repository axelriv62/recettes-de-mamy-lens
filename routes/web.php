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

Route::resource('/recettes', RecetteController::class);

Route::post('/recettes/{id}/upload', [RecetteController::class, 'upload'])->name('recettes.upload');

Route::get('/home', function () {
    return view('home', ['titre' => 'Home']);
})->middleware(['auth'])->name('home');

Route::get('/accueil', function () {
    return view('statiques.accueil', ['titre' => 'Accueil']);
})->middleware(['auth'])->name('accueil');

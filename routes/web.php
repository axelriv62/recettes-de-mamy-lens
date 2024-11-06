<?php

use App\Http\Controllers\TacheController;
use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/taches', [TacheController::class,'index'])->name('taches.index');
Route::get('/recettes', [RecetteController::class,'index'])->name('recettes.index');

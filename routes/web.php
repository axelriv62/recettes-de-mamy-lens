<?php

use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/taches', [TacheController::class,'index'])->name('taches.index');

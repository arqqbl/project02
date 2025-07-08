<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\FavoriteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return 'Hello, World!';
});

Route::middleware(['auth'])->group(function () {
    Route::post('/mahasiswa/favorite/{recipe}', [FavoriteController::class, 'toggle'])
        ->name('mahasiswa.toggle-favorite');
});

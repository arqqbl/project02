<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionController;
use App\Models\Collection;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return 'Hello, World!';
});

Route::middleware(['auth'])->group(function () {
    Route::post('/mahasiswa/favorite/{recipe}', [CollectionController::class, 'add'])
        ->name('mahasiswa.favorite');
});

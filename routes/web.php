<?php

use App\Http\Controllers\CollectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('test', function () {
    return 'Hello, World!';
});

Route::post('/mahasiswa/favorite/{recipe}', [CollectionController::class, 'add'])
    ->middleware('auth')
    ->name('mahasiswa.favorite');

    
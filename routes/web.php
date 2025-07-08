<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\FavoriteController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return 'Hello, World!';
});

<<<<<<< HEAD

=======
Route::middleware(['auth'])->group(function () {
    Route::post('/mahasiswa/favorite/{recipe}', [FavoriteController::class, 'toggle'])
        ->name('mahasiswa.toggle-favorite');
});
>>>>>>> 6411d53299c4157f889201ccf1fb094d5637e6b0

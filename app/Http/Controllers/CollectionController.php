<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Recipe;

class CollectionController extends Controller
{
    public function add(Request $request, Recipe $recipe)
    {
        $user = auth()->user();

        $collection = Collection::where('user_id', $user->id)
            ->where('recipe_id', $recipe->id)
            ->first();

        if ($collection) {
            $collection->delete();
            $message = 'Resep dihapus dari koleksi favorit.';
        } else {
            Collection::create([
                'user_id' => $user->id,
                'recipe_id' => $recipe->id,
            ]);
            $message = 'Resep ditambahkan ke koleksi favorit.';
        }

        return redirect('/mahasiswa/collections');
    }
}

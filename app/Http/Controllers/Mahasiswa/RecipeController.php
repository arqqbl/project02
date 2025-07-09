<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;


class RecipeController extends Controller
{
    public function toggleFavorite(Request $request, Recipe $recipe)
    {
        $user = Auth::user();

        $already = $user->collections()->where('recipe_id', $recipe->id)->exists();

        if ($already) {
            $user->collections()->detach($recipe->id);
        } else {
            $user->collections()->attach($recipe->id);
        }

        return back();
    }
}

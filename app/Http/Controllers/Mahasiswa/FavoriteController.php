<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class FavoriteController extends Controller
{
    public function toggle($recipeId)
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->back()->with('error', 'Kamu harus login dulu.');
        }

        // Cek apakah resep sudah difavoritkan
        if ($user->collections()->where('recipe_id', $recipeId)->exists()) {
            // Hapus dari koleksi
            $user->collections()->detach($recipeId);
        } else {
            // Tambahkan ke koleksi
            $user->collections()->attach($recipeId);
        }

        return redirect()->back();
    }
}

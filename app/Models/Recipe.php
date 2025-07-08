<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'steps',
        'image'
    ];

    // App\Models\Recipe.php

    public function collectors()
    {
        return $this->belongsToMany(\App\Models\Mahasiswa::class, 'collection_recipe', 'recipe_id', 'mahasiswa_id');
    }
}

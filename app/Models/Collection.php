<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Mahasiswa;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipe_id',
    ];

    public function user()
    {
        return $this->belongsTo(user::class); // ✅ pakai yang sudah di-import
    }

    public function recipe()
    {
        return $this->belongsTo(\App\Models\Recipe::class);
    }



    // public function collections()
    // {
    //     return $this->belongsToMany(Recipe::class, 'collections');
    // }


    // protected static function booted()
    // {
    //     static::creating(function ($collection) {
    //         if (auth('mahasiswa')->check()) {
    //             $collection->mahasiswa_id = auth('mahasiswa')->id();
    //         }
    //     });
    // }
}

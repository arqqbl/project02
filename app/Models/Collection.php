<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Models\Mahasiswa;
use App\Models\Recipe;
=======
use App\Models\Recipe;
use App\Models\Mahasiswa;
>>>>>>> b5693370f76abdfdca6cdc40425a6da922a833d6

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipe_id',
    ];

    public function user()
    {
<<<<<<< HEAD
        return $this->belongsTo(Mahasiswa::class);
=======
        return $this->belongsTo(user::class); // ✅ pakai yang sudah di-import
>>>>>>> b5693370f76abdfdca6cdc40425a6da922a833d6
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

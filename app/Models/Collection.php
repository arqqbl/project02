<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\Recipe;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'mahasiswa_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    protected static function booted()
    {
        static::creating(function ($collection) {
            if (auth('mahasiswa')->check()) {
                $collection->mahasiswa_id = auth('mahasiswa')->id();
            }
        });
    }
}

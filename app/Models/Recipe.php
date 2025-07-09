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

    public function collection()
    {
        return $this->hasMany(Collection::class);
    }

    public function collectedBy()
    {
        return $this->belongsToMany(User::class, 'collections');
    }
}

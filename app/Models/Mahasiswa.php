<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
    use Notifiable;

    // Penting! Supaya Laravel gak nyari tabel 'mahasiswas'
    protected $table = 'mahasiswa';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // App\Models\Mahasiswa.php

    public function collections()
    {
        return $this->belongsToMany(\App\Models\Recipe::class, 'collection_recipe', 'mahasiswa_id', 'recipe_id');
    }
}

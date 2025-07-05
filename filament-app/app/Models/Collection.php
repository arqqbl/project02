<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    // Tambahkan semua kolom yang ingin diisi massal (form)
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    // Relasi ke user pemilik koleksi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi many-to-many ke resep
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    // Opsional: atur agar user_id otomatis terisi saat membuat koleksi
    protected static function booted()
    {
        static::creating(function ($collection) {
            $collection->user_id = auth()->id();
        });
    }
}

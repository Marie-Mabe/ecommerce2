<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_categorie');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produits extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'marque',
        'prixunit',
        'quantite',
        'date_peremption',
        'image',
        'statut',
        'id_categorie'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function articlepaniers()
    {
        return $this->hasMany(ArticlePanier::class, 'id_produit');
    }
}

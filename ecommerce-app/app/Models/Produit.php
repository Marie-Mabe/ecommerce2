<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';

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

    protected $dates = [
        'date_peremption',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'date_peremption' => 'date',
        'statut' => 'boolean'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function paniers()
    {
        return $this->belongsToMany(Panier::class, 'article_paniers', 'id_produit', 'id_panier')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}
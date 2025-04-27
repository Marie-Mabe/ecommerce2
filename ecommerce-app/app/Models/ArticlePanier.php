<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlePanier extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produit',
        'id_panier',
        'quantite',
        'prixTotal'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }

    public function panier()
    {
        return $this->belongsTo(Panier::class, 'id_panier');
    }
}

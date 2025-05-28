<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'prixTotal'
    ];

    protected $casts = [
        'prixTotal' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relation utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relation avec les articles du panier
    public function articlesPanier()
    {
        return $this->hasMany(ArticlePanier::class, 'id_panier');
    }

    // Relation avec la commande
    public function commande()
    {
        return $this->hasOne(Commande::class, 'id_panier');
    }

    // Relation many-to-many avec les produits
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'article_paniers', 'id_panier', 'id_produit')
                    ->withPivot('quantite', 'prix_unitaire');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class ArticlePanier extends Model
{
    use HasFactory;

    protected $table = 'article_paniers'; // Explicitement définir le nom de table

    protected $fillable = [
        'id_produit',
        'id_panier',
        'quantite',
        'prix_unitaire' // Corriger le nom pour correspondre à la convention
    ];

    protected $casts = [
        'prix_unitaire' => 'decimal:2', // Format décimal avec 2 décimales
        'quantite' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit')
                    ->withTrashed(); // Conserver l'accès aux produits supprimés si nécessaire
    }

    public function panier()
    {
        return $this->belongsTo(Panier::class, 'id_panier')
                    ->with(['utilisateur']); // Charger automatiquement la relation utilisateur
    }
}
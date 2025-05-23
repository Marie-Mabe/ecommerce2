<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'id_produit', 
        'quantite',
        'seuil_alerte'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}
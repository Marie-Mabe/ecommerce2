<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MouvementStock extends Model
{
    protected $table = 'mouvements_stock';
    
    protected $fillable = [
        'produit_id',
        'quantite',
        'type',
        'motif',
        'reference'
    ];

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
} 
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_panier',
        'statut'
    ];

    public function panier()
    {
        return $this->belongsTo(Panier::class, 'id_panier');
    }
}

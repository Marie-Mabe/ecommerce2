<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'prixTotal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function articlepaniers()
    {
        return $this->hasMany(ArticlePanier::class, 'id_panier');
    }

    public function commande()
    {
        return $this->hasOne(Commande::class, 'id_panier');
    }

}

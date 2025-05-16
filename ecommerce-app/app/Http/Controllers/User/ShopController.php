<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\Stock;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::where('statut', true)->with(['categorie', 'fournisseur']);

        // Filtrage par mot-clé
        if ($request->filled('q')) {
            $query->where('libelle', 'like', '%' . $request->q . '%');
        }

        // Filtrage par catégorie
        if ($request->filled('categorie')) {
            $query->where('id_categorie', $request->categorie);
        }

        $produits = $query->latest()->paginate(8);

        // Ajout des catégories
        $categories = Categorie::all();

        return view('user.shop', compact('produits', 'categories'));
    }


    public function show(Produit $produit)
    {
        return view('user.produit.show', compact('produit'));
    }


}

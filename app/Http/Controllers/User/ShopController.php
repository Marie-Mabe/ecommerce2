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
        $query = Produit::where('statut', true);

        // Filtrage par mot-clé
        if ($request->filled('query')) {
            $searchTerm = $request->input('query');
            $query->where(function($q) use ($searchTerm) {
                $q->where('libelle', 'like', '%' . $searchTerm . '%')
                  ->orWhere('marque', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filtrage par catégorie
        if ($request->filled('categorie')) {
            $query->where('id_categorie', $request->input('categorie'));
        }

        // Eager loading des relations
        $query->with(['categorie', 'fournisseur']);

        // Récupération des produits paginés
        $produits = $query->latest()->paginate(8);
        
        // Conserver les paramètres de recherche dans la pagination
        $produits->appends($request->all());

        // Récupération des catégories
        $categories = Categorie::all();

        return view('user.shop', compact('produits', 'categories'));
    }

    public function shop()
    {
        $produits = Produit::with('categorie')->paginate(12);
        $categories = Categorie::all();
        
        return view('user.shop', compact('produits', 'categories'));
    }

    public function show($id)
    {
        // Charge le produit avec sa catégorie et fournisseur
        $produit = Produit::with(['categorie', 'fournisseur'])->findOrFail($id);
        
        // Charge les produits similaires (optionnel)
        $produitsSimilaires = [];
        if ($produit->categorie) {
            $produitsSimilaires = Produit::where('id_categorie', $produit->id_categorie)
                ->where('id', '!=', $id)
                ->take(4)
                ->get();
        }
        
        return view('user.produit.show', [
            'produit' => $produit,
            'produitsSimilaires' => $produitsSimilaires
        ]);
    }
}
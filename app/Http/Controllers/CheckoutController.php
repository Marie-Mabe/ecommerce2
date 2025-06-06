<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;
use App\Models\Commande;
use App\Models\CommandeProduit;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function index()
    {
        // Vérification de l'authentification
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour passer commande');
        }

        // Récupération du panier avec eager loading
        $paniers = Panier::with(['produit' => function($query) {
                $query->select('id', 'libelle', 'prixunit as prix_unitaire', 'image');
            }])
            ->where('id_user', auth()->id())
            ->get();

        // Vérification du panier non vide
        if ($paniers->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Votre panier est vide');
        }

        // Calcul du total
        $total = $paniers->sum(function($item) {
            return $item->prix * $item->quantite;
        });

        // Liste des pays
        $countries = [
            'FR' => 'France',
            'BE' => 'Belgique',
            'CA' => 'Canada',
            // Ajoutez d'autres pays au besoin
        ];

        return view('user.checkout', compact('paniers', 'total', 'countries'));
    }

    public function process(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|size:2',
            'postcode' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|string',
        ]);

        // Utilisation d'une transaction pour plus de sécurité
        return DB::transaction(function () use ($validated) {
            // Récupération des articles du panier
            $paniers = Panier::with('produit')
                ->where('id_user', auth()->id())
                ->get();

            // Calcul du total
            $total = $paniers->sum(function($item) {
                return $item->produit->prixunit * $item->quantite;
            });

            // Création de la commande
            $commande = Commande::create([
                'user_id' => auth()->id(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'country' => $validated['country'],
                'postcode' => $validated['postcode'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'payment_method' => $validated['payment_method'],
                'total' => $total,
                'status' => 'pending',
            ]);

            // Ajout des produits à la commande
            foreach ($paniers as $panier) {
                CommandeProduit::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $panier->id_produit,
                    'quantite' => $panier->quantite,
                    'prix_unitaire' => $panier->produit->prix_unitaire,
                    'prix_total' => $panier->produit->prix_unitaire * $panier->quantite,
                ]);
            }
            // Vider le panier
            Panier::where('id_user', auth()->id())->delete();

            return redirect()
                ->route('user.orders.show', $commande->id)
                ->with('success', 'Votre commande a été passée avec succès!');
        });
    }
}
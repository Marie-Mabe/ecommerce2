<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $paniers = Panier::with('produit')
            ->where('id_user', auth()->id())
            ->get();
            
        $total = $paniers->sum(function($item) {
            return $item->prix * $item->quantite;
        });

        return view('user.cart', compact('paniers', 'total'));
    }

   public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:produits,id'
    ]);

    $produit = Produit::find($request->product_id);

    $panier = Panier::where('id_user', auth()->id())
        ->where('id_produit', $request->product_id)
        ->first();

    if ($panier) {
        $panier->increment('quantite');
    } else {
        Panier::create([
            'id_user' => auth()->id(),
            'id_produit' => $request->product_id,
            'quantite' => 1,
            'prix' => $produit->prixunit
        ]);
    }

    // Retourne une réponse JSON pour l'AJAX
    return response()->json([
        'success' => true,
        'message' => 'Produit ajouté au panier'
    ]);
}

    public function remove($id)
    {
        Panier::where('id_user', auth()->id())
            ->where('id_produit', $id)
            ->delete();

        return back()->with('success', 'Produit retiré du panier');
    }



        public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $panier = Panier::where('id_user', auth()->id())
        ->where('id_produit', $id)
        ->firstOrFail();

    $panier->update(['quantite' => $request->quantity]);

    return response()->json(['success' => true]);
}

    
}
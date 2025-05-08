<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\MouvementStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')
            ->orderBy('quantite', 'asc')
            ->paginate(10);
        return view('admin.stock.index', compact('produits'));
    }

    public function mouvements($produit_id)
    {
        $produit = Produit::findOrFail($produit_id);
        $mouvements = MouvementStock::where('produit_id', $produit_id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.stock.mouvements', compact('produit', 'mouvements'));
    }

    public function ajuster(Request $request, $produit_id)
    {
        $request->validate([
            'quantite' => 'required|integer',
            'type' => 'required|in:entree,sortie',
            'motif' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            $produit = Produit::findOrFail($produit_id);
            $quantite = $request->quantite;

            if ($request->type === 'sortie') {
                if ($produit->quantite < $quantite) {
                    throw new \Exception('Stock insuffisant');
                }
                $quantite = -$quantite;
            }

            // Créer le mouvement de stock
            MouvementStock::create([
                'produit_id' => $produit_id,
                'quantite' => abs($quantite),
                'type' => $request->type,
                'motif' => $request->motif,
                'reference' => $request->reference
            ]);

            // Mettre à jour le stock du produit
            $produit->quantite += $quantite;
            $produit->save();

            DB::commit();

            return redirect()->route('admin.stock.mouvements', $produit_id)
                ->with('success', 'Stock ajusté avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de l\'ajustement du stock : ' . $e->getMessage());
        }
    }

    public function alerte()
    {
        $produits = Produit::whereRaw('quantite <= seuil_alerte')
            ->orderBy('quantite', 'asc')
            ->with('categorie')
            ->get();
            
        return view('admin.stock.alerte', compact('produits'));
    }
} 
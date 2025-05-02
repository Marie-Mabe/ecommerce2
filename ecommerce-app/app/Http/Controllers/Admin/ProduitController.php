<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('categorie')
            ->latest()
            ->paginate(10);
            
        return view('admin.produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.produits.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'prixunit' => 'required|numeric|min:0.01',
            'quantite' => 'required|integer|min:0',
            'date_peremption' => 'required|date|after:today',
            'id_categorie' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'statut' => 'sometimes|boolean',
        ]);

        try {
            // Génération d'un nom de fichier unique
            $imageName = time() . '_' . Str::slug(pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs(
                'produits', 
                $imageName . '.' . $extension, 
                'public'
            );

            Produit::create([
                'libelle' => $validated['libelle'],
                'marque' => $validated['marque'],
                'prixunit' => $validated['prixunit'],
                'quantite' => $validated['quantite'],
                'date_peremption' => $validated['date_peremption'],
                'id_categorie' => $validated['id_categorie'],
                'statut' => $request->has('statut'),
                'image' => $path
            ]);

            return redirect()->route('admin.produits.index')
                ->with('success', 'Produit créé avec succès');

        } catch (\Exception $e) {
            if(isset($path)) {
                Storage::disk('public')->delete($path);
            }
            return back()->withInput()
                ->with('error', "Erreur de création : " . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'prixunit' => 'required|numeric|min:0.01',
            'quantite' => 'required|integer|min:0',
            'date_peremption' => 'required|date',
            'id_categorie' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'statut' => 'sometimes|boolean'
        ]);

        try {
            // Gestion de l'image
            if ($request->hasFile('image')) {
                // Suppression ancienne image
                if ($produit->image) {
                    Storage::disk('public')->delete($produit->image);
                }
                
                // Upload nouvelle image
                $imageName = time() . '_' . Str::slug(pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->storeAs(
                    'produits', 
                    $imageName . '.' . $extension, 
                    'public'
                );
                $validated['image'] = $path;
            }

            $produit->update([
                'libelle' => $validated['libelle'],
                'marque' => $validated['marque'],
                'prixunit' => $validated['prixunit'],
                'quantite' => $validated['quantite'],
                'date_peremption' => $validated['date_peremption'],
                'id_categorie' => $validated['id_categorie'],
                'statut' => $request->has('statut'),
                'image' => $validated['image'] ?? $produit->image
            ]);

            return redirect()->route('admin.produits.index')
                ->with('success', 'Produit mis à jour avec succès');

        } catch (\Exception $e) {
            if(isset($path)) {
                Storage::disk('public')->delete($path);
            }
            return back()->withInput()
                ->with('error', "Erreur de mise à jour : " . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        try {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            
            $produit->delete();

            return redirect()->route('admin.produits.index')
                ->with('success', 'Produit supprimé avec succès');

        } catch (\Exception $e) {
            return redirect()->route('admin.produits.index')
                ->with('error', 'Erreur de suppression : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }
}
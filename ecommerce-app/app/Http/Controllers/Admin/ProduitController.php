<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProduitController extends Controller
{
    protected $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'image/avif'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with(['categorie', 'fournisseur'])
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
        $fournisseurs = Fournisseur::where('actif', true)->get();
        return view('admin.produits.create', compact('categories', 'fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Vérification du fichier avant validation
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
            return back()->withInput()->withErrors(['image' => 'Le type de fichier n\'est pas autorisé. Types acceptés : JPEG, PNG, GIF, WEBP, AVIF']);
        }
    }

    $validated = $request->validate([
        'libelle' => 'required|string|max:255',
        'marque' => 'required|string|max:255',
        'prixunit' => 'required|numeric|min:0.01',
        'quantite' => 'required|integer|min:0',
        'seuil_alerte' => 'required|integer|min:0',
        'date_peremption' => 'nullable|date|after:today',
        'id_categorie' => 'required|exists:categories,id',
        'fournisseur_id' => 'nullable|exists:fournisseurs,id',
        'image' => 'required|file|max:5120',
        'statut' => 'sometimes|boolean',
    ]);

    try {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // Récupère l'extension, ex: "jpg"
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Récupère le nom sans extension
        $sluggedName = Str::slug($originalName); // Transforme le nom en slug
        $imageName = time() . '_' . $sluggedName . '.' . $extension; // Ajoute le point et l'extension

        $path = $file->storeAs(
            'produits',
            $imageName,
            'public'
        );

        Produit::create([
            'libelle' => $validated['libelle'],
            'marque' => $validated['marque'],
            'prixunit' => $validated['prixunit'],
            'quantite' => $validated['quantite'],
            'seuil_alerte' => $validated['seuil_alerte'],
            'date_peremption' => $validated['date_peremption'],
            'id_categorie' => $validated['id_categorie'],
            'fournisseur_id' => $validated['fournisseur_id'],
            'statut' => $request->has('statut'),
            'image' => $path
        ]);

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit créé avec succès');

    } catch (\Exception $e) {
        if (isset($path)) {
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
    // Vérification du fichier avant validation
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
            return back()->withInput()->withErrors(['image' => 'Le type de fichier n\'est pas autorisé. Types acceptés : JPEG, PNG, GIF, WEBP, AVIF']);
        }
    }

    $produit = Produit::findOrFail($id);

    $validated = $request->validate([
        'libelle' => 'required|string|max:255',
        'marque' => 'required|string|max:255',
        'prixunit' => 'required|numeric|min:0.01',
        'quantite' => 'required|integer|min:0',
        'seuil_alerte' => 'required|integer|min:0',
        'date_peremption' => 'nullable|date',
        'id_categorie' => 'required|exists:categories,id',
        'fournisseur_id' => 'nullable|exists:fournisseurs,id',
        'image' => 'nullable|file|max:5120',
        'statut' => 'sometimes|boolean'
    ]);

    try {
        if ($request->hasFile('image')) {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $sluggedName = Str::slug($originalName);
            $imageName = time() . '_' . $sluggedName . '.' . $extension;

            $path = $file->storeAs(
                'produits',
                $imageName,
                'public'
            );
            $validated['image'] = $path;
        }

        $produit->update([
            'libelle' => $validated['libelle'],
            'marque' => $validated['marque'],
            'prixunit' => $validated['prixunit'],
            'quantite' => $validated['quantite'],
            'seuil_alerte' => $validated['seuil_alerte'],
            'date_peremption' => $validated['date_peremption'],
            'id_categorie' => $validated['id_categorie'],
            'fournisseur_id' => $validated['fournisseur_id'],
            'statut' => $request->has('statut'),
            'image' => $validated['image'] ?? $produit->image
        ]);

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit mis à jour avec succès');

    } catch (\Exception $e) {
        if (isset($path)) {
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
        $fournisseurs = Fournisseur::where('actif', true)->get();
        return view('admin.produits.edit', compact('produit', 'categories', 'fournisseurs'));
    }
}

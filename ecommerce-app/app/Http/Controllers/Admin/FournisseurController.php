<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::latest()->paginate(10);
        return view('admin.fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('admin.fournisseurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:fournisseurs',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'description' => 'nullable|string',
            'actif' => 'sometimes|boolean'
        ]);

        try {
            Fournisseur::create($validated);
            return redirect()->route('admin.fournisseurs.index')
                ->with('success', 'Fournisseur créé avec succès');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur lors de la création du fournisseur');
        }
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('admin.fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:fournisseurs,email,' . $fournisseur->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'description' => 'nullable|string',
            'actif' => 'sometimes|boolean'
        ]);

        try {
            $fournisseur->update($validated);
            return redirect()->route('admin.fournisseurs.index')
                ->with('success', 'Fournisseur mis à jour avec succès');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur lors de la mise à jour du fournisseur');
        }
    }

    public function destroy(Fournisseur $fournisseur)
    {
        try {
            if($fournisseur->produits()->count() > 0) {
                return back()->with('error', 'Ce fournisseur ne peut pas être supprimé car il a des produits associés');
            }
            
            $fournisseur->delete();
            return redirect()->route('admin.fournisseurs.index')
                ->with('success', 'Fournisseur supprimé avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression du fournisseur');
        }
    }

    public function show(Fournisseur $fournisseur)
    {
        $produits = $fournisseur->produits()->paginate(10);
        return view('admin.fournisseurs.show', compact('fournisseur', 'produits'));
    }
} 
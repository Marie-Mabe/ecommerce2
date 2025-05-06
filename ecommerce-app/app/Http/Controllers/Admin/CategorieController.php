<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255|unique:categories',
            'description' => 'required|string|max:255'
        ]);

        try {
            Categorie::create($validated);
            return redirect()->route('admin.categories.index')
                ->with('success', 'Catégorie créée avec succès');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur lors de la création de la catégorie');
        }
    }

    public function edit(Categorie $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Categorie $category)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255|unique:categories,libelle,' . $category->id,
            'description' => 'required|string|max:255'
        ]);

        try {
            $category->update($validated);
            return redirect()->route('admin.categories.index')
                ->with('success', 'Catégorie mise à jour avec succès');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erreur lors de la mise à jour de la catégorie');
        }
    }

    public function destroy(Categorie $category)
    {
        try {
            if($category->produits()->count() > 0) {
                return back()->with('error', 'Impossible de supprimer cette catégorie car elle contient des produits');
            }
            
            $category->delete();
            return redirect()->route('admin.categories.index')
                ->with('success', 'Catégorie supprimée avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression de la catégorie');
        }
    }
} 
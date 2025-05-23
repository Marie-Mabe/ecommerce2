@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            @if($produit->image)
                <img src="{{ asset('storage/' . $produit->image) }}" class="img-fluid rounded" alt="{{ $produit->nom }}">
            @else
                <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="Image par défaut">
            @endif
        </div>
        
        <div class="col-md-6">
            <h1 class="mb-3">{{ $produit->nom }}</h1>
            
            @if($produit->categorie)
                <p class="text-muted">Catégorie: {{ $produit->categorie->name }}</p>
            @endif
            
            <h3 class="text-primary mb-4">{{ number_format($produit->prix, 2) }} €</h3>
            
            <p class="mb-4">{{ $produit->description }}</p>
            
            <form action="{{ route('cart.add', $produit->id) }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="quantity" class="form-label">Quantité</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-cart-plus"></i> Ajouter au panier
                </button>
            </form>
            
            <div class="mt-4">
                <a href="{{ route('user.shop') }}" class="text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Retour à la boutique
                </a>
            </div>
        </div>
    </div>
    
    @if($produit->categorie && $produit->categorie->produits->count() > 1)
    <div class="row mt-5">
        <div class="col-12">
            <h3>Produits similaires</h3>
            <div class="row">
                @foreach($produit->categorie->produits->where('id', '!=', $produit->id)->take(4) as $produitSimilaire)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <a href="{{ route('user.produit.show', $produitSimilaire->id) }}">
                                @if($produitSimilaire->image)
                                    <img src="{{ asset('storage/' . $produitSimilaire->image) }}" class="card-img-top" alt="{{ $produitSimilaire->nom }}">
                                @else
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Image par défaut">
                                @endif
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $produitSimilaire->nom }}</h5>
                                <p class="card-text text-primary">{{ number_format($produitSimilaire->prix, 2) }} €</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
{{-- resources/views/user/produit/show.blade.php --}}
@extends('user.navigation.layout')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Image du produit -->
            @if($produit->image)
                <img src="{{ asset('storage/' . $produit->image) }}" class="img-fluid rounded" alt="{{ $produit->libelle }}">
            @else
                <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="Image par défaut">
            @endif
        </div>
        
        <div class="col-md-6">
            <!-- Détails du produit -->
            <h1 class="mb-3">{{ $produit->libelle }}</h1>
            
            @if($produit->categorie)
                <p class="text-muted">Catégorie: {{ $produit->categorie->libelle }}</p>
            @endif
            
            <h3 class="text-primary mb-4">{{ number_format($produit->prixunit, 2) }} €</h3>
            
            <p class="mb-4">{{ $produit->description }}</p>
            
            <!-- Formulaire d'ajout au panier -->
            <form action="{{ route('cart.add', $produit->id) }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="quantity" class="form-label">Quantité</label>
                        <input type="number" 
                               class="form-control" 
                               id="quantity" 
                               name="quantity" 
                               value="1" 
                               min="1"
                               max="{{ $produit->stock ?? 100 }}">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-cart-plus"></i> Ajouter au panier
                </button>
            </form>
            
            <!-- Retour à la boutique -->
            <div class="mt-4">
                <a href="{{ route('user.shop') }}" class="text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Retour à la boutique
                </a>
            </div>
        </div>
    </div>
    
    <!-- Produits similaires -->
    @if(!empty($produitsSimilaires))
    <div class="row mt-5">
        <div class="col-12">
            <h3>Produits similaires</h3>
            <div class="row">
                @foreach($produitsSimilaires as $similaire)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <a href="{{ route('user.produit.show', $similaire->id) }}">
                                @if($similaire->image)
                                    <img src="{{ asset('storage/' . $similaire->image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $similaire->libelle }}">
                                @else
                                    <img src="https://via.placeholder.com/300" 
                                         class="card-img-top" 
                                         alt="Image par défaut">
                                @endif
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $similaire->libelle }}</h5>
                                <p class="card-text text-primary">
                                    {{ number_format($similaire->prixunit, 2) }} €
                                </p>
                                        @if($similaire->stock && $similaire->stock->quantite > 0)
                                            <small class="text-success">
                                                <i class="bi bi-check-circle-fill"></i> En stock ({{ $similaire->stock->quantite }})
                                            </small>
                                        @else
                                            <small class="text-danger">
                                                <i class="bi bi-x-circle-fill"></i> Rupture de stock
                                            </small>
                                        @endif
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

@section('styles')
<style>
    .img-fluid {
        max-height: 500px;
        width: 100%;
        object-fit: contain;
    }
    
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: contain;
        padding: 10px;
        background: #f8f9fa;
    }
    
    .product-description {
        white-space: pre-line;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validation de la quantité
        document.querySelector('form').addEventListener('submit', function(e) {
            const quantity = document.getElementById('quantity').value;
            const max = document.getElementById('quantity').max;
            
            if(quantity < 1 || quantity > max) {
                e.preventDefault();
                alert('Veuillez choisir une quantité valide (1-' + max + ')');
            }
        });
    });
</script>
@endsection
@extends('user.navigation.layout')

@section('tittle', 'Shop')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* Search Bar Container */
    .search-bar-container {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
        padding: 1rem;
    }

    .search-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
        background: #ffffff;
        border-radius: 50px;
        padding: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .search-form:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .search-form .form-select,
    .search-form .form-control {
        border: none;
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        background: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .search-form .form-select:focus,
    .search-form .form-control:focus {
        background: #ffffff;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        outline: none;
    }

    .search-form .input-group {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .search-form .btn-search {
        border-radius: 50px;
        background-color: #6f42c1;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .search-form .btn-search:hover {
        background-color: #5a32a3;
    }

    .search-form .btn-search i {
        font-size: 1.2rem;
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        margin: 20px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    /* Product Cards */
    .product-item {
        display: block;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 15px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #212529;
        background: white;
        height: 100%;
    }

    .product-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(111, 66, 193, 0.1);
        border-color: #6f42c1;
    }

    .product-thumbnail {
        border-radius: 8px;
        height: 200px;
        width: 100%;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .product-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #343a40;
    }

    .product-price {
        color: #6f42c1;
        font-size: 1.2rem;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px;
        border: none;
    }

    .modal-header {
        background-color: #6f42c1;
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .btn-close {
        filter: invert(1);
    }

    /* Alert Styling */
    .alert-info {
        background-color: #f0e6ff;
        border-color: #d9c2ff;
        color: #4a2d7f;
    }

    /* Pagination Styling */
    .pagination .page-item.active .page-link {
        background-color: #6f42c1;
        border-color: #6f42c1;
    }

    .pagination .page-link {
        color: #6f42c1;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .search-form {
            flex-direction: column;
            border-radius: 20px;
            padding: 1rem;
        }

        .search-form .form-select,
        .search-form .form-control {
            width: 100%;
        }

        .search-form .btn-search {
            width: 100%;
            justify-content: center;
        }
        
        .product-thumbnail {
            height: 150px;
        }
    }
</style>

<!-- Start Hero Section -->
<div class="hero py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mb-4">
                <h2 class="display-6 fw-bold" style="color: #6f42c1;">Notre Boutique en Ligne</h2>
                <p class="lead">Découvrez nos produits de qualité</p>
            </div>
            <div class="col-lg-8">
                <form action="{{ route('user.shop') }}" method="GET" class="search-bar-container search-form">
                    <div class="col-md-4">
                        <label for="categorie" class="visually-hidden">Catégorie</label>
                        <select name="categorie" class="form-select" id="categorie" aria-label="Sélectionner une catégorie">
                            <option value="">Toutes les catégories</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8 input-group">
                        <label for="search-query" class="visually-hidden">Rechercher un produit</label>
                        <input type="text" name="query" class="form-control" id="search-query"
                               placeholder="Rechercher un produit..."
                               value="{{ request('query') }}"
                               aria-label="Rechercher un produit">
                        <button type="submit" class="btn btn-search">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Products Section -->
<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        @if(request('query') || request('categorie'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        Résultats de recherche 
                        @if(request('query'))
                            pour "{{ request('query') }}"
                        @endif
                        @if(request('categorie'))
                            dans la catégorie "{{ $categories->find(request('categorie'))?->libelle }}"
                        @endif
                        <a href="{{ route('user.shop') }}" class="float-end">Réinitialiser</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            @forelse ($produits as $produit)
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="{{ route('user.produit.show', $produit->id) }}">
                        <img src="{{ Storage::url($produit->image) }}" class="img-fluid product-thumbnail" alt="{{ $produit->libelle }}">
                        <h3 class="product-title">{{ $produit->libelle }}</h3>
                        <strong class="product-price">{{ number_format($produit->prixunit, 2) }}$</strong>
                        <span class="icon-cross product-detail-btn"
                              data-bs-toggle="modal"
                              data-bs-target="#productDetailModal"
                              data-id="{{ $produit->id }}"
                              data-image="{{ Storage::url($produit->image) }}"
                              data-title="{{ $produit->libelle }}"
                              data-marque="{{ $produit->marque }}"
                              data-price="{{ number_format($produit->prixunit, 2) }}$">
                            <img src="{{ asset('images/cross.svg') }}" class="img-fluid">
                        </span>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Aucun produit ne correspond à votre recherche.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="row">
            <div class="col-12">
                {{ $produits->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal détails produit -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailModalLabel">Détails du produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <img id="modal-product-image" src="" alt="" class="img-fluid mb-3" style="width: 100%; max-height: 300px; object-fit: cover;">
                <h4 id="modal-product-title"></h4>
                <p id="modal-product-marque" class="fw-bold"></p>
                <p id="modal-product-price" class="fw-bold"></p>
                <button id="add-to-cart-btn" class="btn btn-primary w-100 py-2" style="background-color: #6f42c1; border: none;">
                    <i class="fas fa-cart-plus me-2"></i> Ajouter au panier
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/tiny-slider.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
document.querySelectorAll('.product-detail-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        const image = this.getAttribute('data-image');
        const title = this.getAttribute('data-title');
        const marque = this.getAttribute('data-marque');
        const price = this.getAttribute('data-price');
        const productId = this.getAttribute('data-id');

        document.getElementById('modal-product-image').src = image;
        document.getElementById('modal-product-image').alt = title;
        document.getElementById('modal-product-title').textContent = title;
        document.getElementById('modal-product-marque').textContent = 'Marque: ' + marque;
        document.getElementById('modal-product-price').textContent = price;

        const addToCartBtn = document.getElementById('add-to-cart-btn');
        addToCartBtn.setAttribute('data-id', productId);
    });
});

document.getElementById('add-to-cart-btn').addEventListener('click', function() {
    const productId = this.getAttribute('data-id');
    
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            window.location.href = '{{ route("user.cart") }}';
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue');
    });
});
</script>
@endsection
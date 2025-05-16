@extends('user.navigation.layout')

@section('tittle', 'Shop')

@section('content')
<style>
    .product-thumbnail {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
    }

    .search-bar-container {
        position: relative;
        max-width: 500px;
        margin: 0 auto;

    }

    .search-bar-container input[type="text"] {
        padding-right: 120px;
        width: 2500px;
    }

    .search-bar-container button {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        border: none;

        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>

<!-- Start Hero Section -->
<div class="hero py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-lg-8">
                <div class="">
                   <form action="{{ route('user.shop') }}" method="GET" class="search-bar-container d-flex align-items-stretch">

                        <!-- Menu déroulant des catégories -->
                        <select name="categorie" class="form-select me-2" onchange="this.form.submit()" style="max-width: 200px; font-size: 14px;">

                            <option value="">Toutes les catégories</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->libelle }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Champ de recherche -->
                        <input type="text" name="query" class="form-control me-2"
                            placeholder="Rechercher un produit..." value="{{ request('query') }}">

                        <!-- Bouton de recherche -->
                        <button type="submit" class="btn btn-secondary px-4">Rechercher</button>
                    </form>

            </div>
            </div>


        </div>
    </div>
</div>

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
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
                    <p class="text-center">Aucun produit disponible pour le moment.</p>
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
        <!-- Bouton Ajouter au panier -->
        <button id="add-to-cart-btn" class="btn btn-primary">Ajouter au panier</button>
      </div>
      {{--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>  --}}
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
        e.preventDefault(); // éviter le comportement par défaut du lien

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

        // Stocker l'id du produit sur le bouton Ajouter au panier
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        addToCartBtn.setAttribute('data-id', productId);
    });
});

// Exemple gestion clic sur Ajouter au panier
document.getElementById('add-to-cart-btn').addEventListener('click', function() {
    const productId = this.getAttribute('data-id');
    alert('Produit ajouté au panier : ID = ' + productId);
    // Ici tu peux faire un appel AJAX pour ajouter au panier côté serveur
});
</script>
@endsection

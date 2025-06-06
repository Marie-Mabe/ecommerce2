@extends('user.navigation.layout')

@section('title', 'Panier')

@section('content')
<style>
    .hero-cart {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        padding: 80px 0;
    }
    
    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
    }
    
    .cart-table thead th {
        border-bottom: 2px solid #dee2e6;
        padding: 15px;
        text-align: left;
    }
    
    .cart-table tbody tr {
        background-color: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .cart-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .cart-table td {
        padding: 15px;
        vertical-align: middle;
    }
    
    .quantity-btn {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ddd;
        background: #f8f9fa;
        cursor: pointer;
        user-select: none;
    }
    
    .quantity-btn:hover {
        background: #e9ecef;
    }
    
    .quantity-input {
        width: 50px;
        text-align: center;
        border: 1px solid #ddd;
        border-left: none;
        border-right: none;
        height: 30px;
    }
    
    .remove-btn {
        background: #dc3545;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .remove-btn:hover {
        background: #c82333;
        transform: scale(1.1);
    }
    
    .cart-summary {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .btn-continue {
        border: 2px solid #2f89fc;
        color: #2f89fc;
        transition: all 0.3s;
    }
    
    .btn-continue:hover {
        background: #2f89fc;
        color: white;
    }
    
    .btn-checkout {
        background: #28a745;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-checkout:hover {
        background: #218838;
        transform: translateY(-2px);
    }
</style>

<div class="hero-cart text-white">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-8 mx-auto text-center">
                <div class="intro-excerpt">
                    <h1 class="display-4">Votre Panier</h1>
                    <p class="lead mb-0">Revoyez et modifiez votre sélection</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="untree_co-section before-footer-section">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Produit</th>
                                <th class="product-price">Prix</th>
                                <th class="product-quantity">Quantité</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paniers as $panier)
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{ Storage::url($panier->produit->image) }}" alt="Image" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{ $panier->produit->libelle }}</h2>
                                    </td>
                                    <td>{{ number_format($panier->prix, 2) }}$</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <button class="quantity-btn decrease" type="button" data-product-id="{{ $panier->id_produit }}">&minus;</button>
                                            <input type="text" class="quantity-input" 
                                                   value="{{ $panier->quantite }}" 
                                                   data-product-id="{{ $panier->id_produit }}"
                                                   readonly>
                                            <button class="quantity-btn increase" type="button" data-product-id="{{ $panier->id_produit }}">&plus;</button>
                                        </div>
                                    </td>
                                    <td>{{ number_format($panier->prix * $panier->quantite, 2) }}$</td>
                                    <td>
                                        <form action="{{ route('user.cart.remove', $panier->id_produit) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-btn">X</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <h4 class="text-muted">Votre panier est vide</h4>
                                        <a href="{{ route('user.shop') }}" class="btn btn-primary mt-3">Commencer vos achats</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        @if(count($paniers) > 0)
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('user.shop') }}" class="btn btn-continue btn-lg btn-block py-3">Continuer vos achats</a>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="cart-summary">
                            <div class="row">
                                <div class="col-md-12 text-center border-bottom mb-4">
                                    <h3 class="text-black h4">Récapitulatif</h3>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <span class="text-black">Sous-total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">${{ number_format($total, 2) }}</strong>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <span class="text-black">Livraison</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Gratuite</strong>
                                </div>
                            </div>
                            <div class="row mb-4 pt-3 border-top">
                                <div class="col-md-6">
                                    <span class="text-black font-weight-bold">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-primary h5">${{ number_format($total, 2) }}</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('checkout') }}" class="btn btn-checkout btn-lg py-3 btn-block">Passer la commande</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Gestion des boutons +/-
        $('.increase').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var input = $(this).siblings('.quantity-input');
            var newVal = parseInt(input.val()) + 1;
            input.val(newVal);
            updateQuantity(productId, newVal);
        });

        $('.decrease').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var input = $(this).siblings('.quantity-input');
            var newVal = parseInt(input.val()) - 1;
            if (newVal >= 1) {
                input.val(newVal);
                updateQuantity(productId, newVal);
            }
        });

        function updateQuantity(productId, quantity) {
            $.ajax({
                url: '{{ route("user.cart.update", ["id" => ":id"]) }}'.replace(':id', productId),
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr) {
                    alert('Une erreur est survenue lors de la mise à jour de la quantité');
                    window.location.reload();
                }
            });
        }
    });
    
</script>
@endsection
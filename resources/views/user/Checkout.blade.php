@extends('user.navigation.layout')

@section('content')
<style>
    .hero-checkout {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }
    
    .checkout-container {
        margin-top: -50px;
        position: relative;
        z-index: 2;
    }
    
    .checkout-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .checkout-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: #333;
        border-bottom: 2px solid #f1f1f1;
        padding-bottom: 15px;
    }
    
    .form-control {
        height: 45px;
        border-radius: 5px;
        border: 1px solid #e1e1e1;
    }
    
    .form-control:focus {
        border-color: #2f89fc;
        box-shadow: 0 0 0 0.25rem rgba(47, 137, 252, 0.25);
    }
    
    .order-summary {
        background: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
    }
    
    .order-table {
        width: 100%;
    }
    
    .order-table th, .order-table td {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }
    
    .order-table tr:last-child th, 
    .order-table tr:last-child td {
        border-bottom: none;
    }
    
    .payment-method {
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .payment-method:hover {
        border-color: #2f89fc;
        background: #f8fbff;
    }
    
    .payment-method.active {
        border-color: #2f89fc;
        background: #f8fbff;
    }
    
    .btn-checkout {
        background: #28a745;
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 5px;
        transition: all 0.3s;
        border: none;
        width: 100%;
    }
    
    .btn-checkout:hover {
        background: #218838;
        transform: translateY(-2px);
    }
    
    .promo-code {
        position: relative;
    }
    
    .promo-code .btn-apply {
        position: absolute;
        right: 5px;
        top: 5px;
        background: #333;
        color: white;
        border: none;
        padding: 5px 15px;
        border-radius: 4px;
    }
    
    .promo-code .form-control {
        padding-right: 100px;
    }
    
    @media (max-width: 767px) {
        .checkout-container {
            margin-top: 0;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-checkout text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 mb-3">Finalisez votre commande</h1>
                <p class="lead">Remplissez vos informations pour compléter votre achat</p>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Form -->
<div class="untree_co-section">
    <div class="container checkout-container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="checkout-box">
                    <h2 class="checkout-title">Détails de facturation</h2>
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="c_fname" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="c_lname" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="last_name" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="c_email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="c_email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="c_phone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="c_phone" name="phone" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="c_country" class="form-label">Pays <span class="text-danger">*</span></label>
                            <select id="c_country" class="form-control" name="country" required>
                                <option value="">Sélectionnez un pays</option>
                                @foreach($countries as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="c_address" class="form-label">Adresse <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_address" name="address" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="c_apartment" class="form-label">Appartement, suite (optionnel)</label>
                            <input type="text" class="form-control" id="c_apartment" name="apartment">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="c_city" class="form-label">Ville <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_city" name="city" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="c_postal" class="form-label">Code postal <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_postal" name="postal_code" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="create_account" name="create_account">
                                <label class="form-check-label" for="create_account">Créer un compte ?</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="different_shipping" name="different_shipping">
                                <label class="form-check-label" for="different_shipping">Expédier à une adresse différente ?</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="c_notes" class="form-label">Notes de commande</label>
                            <textarea class="form-control" id="c_notes" name="notes" rows="4"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="checkout-box">
                    <h2 class="checkout-title">Votre commande</h2>
                    
                    <div class="order-summary mb-4">
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paniers as $panier)
                                <tr>
                                    <td>{{ $panier->produit->libelle }} × {{ $panier->quantite }}</td>
                                    <td class="text-end">{{ number_format($panier->prix * $panier->quantite, 2) }} €</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>Sous-total</th>
                                    <td class="text-end">{{ number_format($total, 2) }} €</td>
                                </tr>
                                <tr>
                                    <th>Livraison</th>
                                    <td class="text-end">Gratuite</td>
                                </tr>
                                <tr class="border-top">
                                    <th class="pt-3">Total</th>
                                    <td class="text-end pt-3 h5 text-primary">{{ number_format($total, 2) }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mb-4">
                        <div class="promo-code mb-3">
                            <label for="c_code" class="form-label">Code promo</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="c_code" placeholder="Entrez votre code">
                                <button class="btn btn-sm btn-dark">Appliquer</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="payment-options mb-4">
                        <h3 class="h5 mb-3">Méthode de paiement</h3>
                        
                        <div class="payment-method active" id="bank-transfer">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank-transfer-radio" value="bank_transfer" checked>
                                <label class="form-check-label fw-bold" for="bank-transfer-radio">
                                    Virement bancaire
                                </label>
                                <p class="mb-0 text-muted small">Effectuez un virement directement sur notre compte bancaire.</p>
                            </div>
                        </div>
                        
                        <div class="payment-method" id="paypal-method">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="paypal-radio" value="paypal">
                                <label class="form-check-label fw-bold" for="paypal-radio">
                                    PayPal
                                </label>
                                <p class="mb-0 text-muted small">Payer en toute sécurité via PayPal.</p>
                            </div>
                            
                            <div id="paypal-button-container" class="mt-3 d-none"></div>
                        </div>
                    </div>
                    
                    <button type="submit" form="checkout-form" class="btn btn-checkout btn-lg">
                        Passer la commande
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if(config('services.paypal.client_id'))
<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency={{ config('services.paypal.currency') }}"></script>
<script>
    // Gestion des méthodes de paiement
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
            this.classList.add('active');
            document.querySelector(`#${this.id}-radio`).checked = true;
            
            // Gestion spécifique pour PayPal
            if (this.id === 'paypal-method') {
                document.querySelector('#paypal-button-container').classList.remove('d-none');
            } else {
                document.querySelector('#paypal-button-container').classList.add('d-none');
            }
        });
    });

    // Initialisation PayPal
    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'blue',
            shape: 'rect',
            label: 'paypal'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $total }}',
                        currency_code: 'EUR'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Ajouter un champ caché pour le paiement PayPal
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'paypal_order_id';
                input.value = data.orderID;
                document.getElementById('checkout-form').appendChild(input);
                
                // Soumettre le formulaire
                document.getElementById('checkout-form').submit();
            });
        },
        onError: function(err) {
            console.error('Erreur PayPal:', err);
            alert('Une erreur est survenue lors du traitement PayPal. Veuillez réessayer.');
        }
    }).render('#paypal-button-container');
</script>
@endif

<script>
    // Validation du formulaire avant soumission
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
        
        if (selectedPayment === 'paypal') {
            e.preventDefault();
            alert('Veuillez compléter le paiement via PayPal en utilisant le bouton PayPal ci-dessus.');
        }
    });
</script>
@endsection
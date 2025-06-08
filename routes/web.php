<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\StockDashboardController;
use App\Http\Controllers\Admin\FournisseurController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', function () {
    return view('welcome');
});

// Redirection après login selon le rôle
Route::get('/dashboard', function () {
    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.shop');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboards
Route::get('/admin/dashboard', function () {
    return view('admin.layout');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/user/shop', function () {
    return view('user.shop');
})->middleware(['auth', 'verified'])->name('user.shop');


// Routes de profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
});

// Routes Admin
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('produits', ProduitController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('fournisseurs', FournisseurController::class);

    // Gestion de stock
    Route::get('stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('stock/alerte', [StockController::class, 'alerte'])->name('stock.alerte');
    Route::get('stock/{produit}/mouvements', [StockController::class, 'mouvements'])->name('stock.mouvements');
    Route::post('stock/{produit}/ajuster', [StockController::class, 'ajuster'])->name('stock.ajuster');

    // Tableau de bord du stock
    Route::get('stock/dashboard', [StockDashboardController::class, 'index'])->name('stock.dashboard');

    // Update produit personnalisé (si nécessaire)
    Route::put('produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
});

// Routes utilisateur
Route::prefix('user')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('user.shop');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
    Route::get('/about', [AboutController::class, 'index'])->name('user.about');
    Route::get('/contact', [ContactController::class, 'index'])->name('user.contact');
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

// Détail produit
Route::get('/produit/{id}', [ShopController::class, 'show'])->name('user.produit.show');

// Panier
Route::middleware(['auth'])->prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('user.cart.update');
});


// Checkout (auth requis)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Page de remerciement
Route::get('/thankyou', function () {
    return view('user.thankyou');
})->name('user.thankyou');

// Route de test email
Route::get('/test-mail', function () {
    \Mail::raw('Test d\'envoi d\'email', function ($message) {
        $message->to('votre@email.com')
            ->subject('Test de configuration email');
    });
    return 'Email de test envoyé !';
});

// Déconnexion personnalisée (si besoin en dehors de Laravel Breeze/Fortify)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Routes d’authentification (gérées par Laravel Breeze/Fortify)
require __DIR__ . '/auth.php';

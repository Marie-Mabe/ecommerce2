<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\CategorieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- Ajoute ça
use Illuminate\Support\Facades\ShopController;
use Illuminate\Support\Facades\AboutController;
use Illuminate\Support\Facades\ServicesController;
use Illuminate\Support\Facades\BlogController;
use Illuminate\Support\Facades\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Cette route décide où envoyer l'utilisateur après login
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Route pour Admin
Route::get('/admin/dashboard', function () {
    return view('admin.layout');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Route pour User
Route::get('/user/dashboard', function () {
    return view('user.dashboard'); 
})->middleware(['auth', 'verified'])->name('user.dashboard');



// Routes pour le profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('produits', ProduitController::class);
    Route::resource('categories', CategorieController::class);
});
Route::put('/admin/produits/{id}', [ProduitController::class, 'update'])->name('admin.produits.update');

// Routes pour l'utilisateur
Route::prefix('user')->group(function () {
    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('user.dashboard');
    
    // Autres pages
    Route::get('/shop', [\App\Http\Controllers\User\ShopController::class, 'index'])->name('user.shop');
    Route::get('/about', [\App\Http\Controllers\User\AboutController::class, 'index'])->name('user.about');
    Route::get('/service', [\App\Http\Controllers\User\ServicesController::class, 'index'])->name('user.service');
    Route::get('/blog', [\App\Http\Controllers\User\BlogController::class, 'index'])->name('user.blog');
    Route::get('/contact', [\App\Http\Controllers\User\ContactController::class, 'index'])->name('user.contact');
    Route::get('/cart', [\App\Http\Controllers\User\CartController::class, 'index'])->name('user.cart');
});


require __DIR__.'/auth.php';

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\CartController;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            View::composer('*', function ($view) {
        $totalQuantite = auth()->check()
            ? Panier::where('id_user', auth()->id())->sum('quantite')
            : 0;

        $view->with('totalPanierQuantite', $totalQuantite);
        });

        Schema::defaultStringLength(191);
    }
}

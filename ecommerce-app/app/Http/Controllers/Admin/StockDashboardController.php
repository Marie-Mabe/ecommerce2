<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\MouvementStock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StockDashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $stats = [
            'total_produits' => Produit::count(),
            'produits_rupture' => Produit::where('quantite', 0)->count(),
            'produits_alerte' => Produit::whereColumn('quantite', '<=', 'seuil_alerte')->count(),
            'produits_expires' => Produit::where('date_peremption', '<', Carbon::now())->count()
        ];

        // Mouvements récents
        $mouvements_recents = MouvementStock::with(['produit'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Produits les plus critiques (en rupture ou proche du seuil)
        $produits_critiques = Produit::with('categorie')
            ->whereColumn('quantite', '<=', 'seuil_alerte')
            ->orderBy('quantite')
            ->take(5)
            ->get();

        // Statistiques des mouvements du mois
        $stats_mouvements = MouvementStock::selectRaw('
                type,
                COUNT(*) as total_mouvements,
                SUM(quantite) as total_quantite
            ')
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy('type')
            ->get()
            ->keyBy('type');

        return view('admin.stock.dashboard', compact(
            'stats',
            'mouvements_recents',
            'produits_critiques',
            'stats_mouvements'
        ));
    }
} 
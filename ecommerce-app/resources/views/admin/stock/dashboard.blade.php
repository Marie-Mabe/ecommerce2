@extends('admin.layout')

@section('title', 'Tableau de bord des stocks')

@section('content')
<div class="row">
    <!-- Statistiques générales -->
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Total Produits</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $stats['total_produits'] }}</h3>
                    <i class="ti-package icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Ruptures</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $stats['produits_rupture'] }}</h3>
                    <i class="ti-alert icon-md text-danger mb-0 mb-md-3 mb-xl-0"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">En Alerte</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $stats['produits_alerte'] }}</h3>
                    <i class="ti-bell icon-md text-warning mb-0 mb-md-3 mb-xl-0"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Périmés</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $stats['produits_expires'] }}</h3>
                    <i class="ti-calendar icon-md text-info mb-0 mb-md-3 mb-xl-0"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Produits critiques -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Produits critiques</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Stock</th>
                                <th>Seuil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits_critiques as $produit)
                            <tr>
                                <td>{{ $produit->libelle }}</td>
                                <td>{{ $produit->categorie->libelle }}</td>
                                <td>
                                    <span class="badge {{ $produit->quantite == 0 ? 'badge-danger' : 'badge-warning' }}">
                                        {{ $produit->quantite }}
                                    </span>
                                </td>
                                <td>{{ $produit->seuil_alerte }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Mouvements récents -->
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Derniers mouvements</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Produit</th>
                                <th>Type</th>
                                <th>Qté</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mouvements_recents as $mouvement)
                            <tr>
                                <td>{{ $mouvement->created_at->format('d/m H:i') }}</td>
                                <td>{{ $mouvement->produit->libelle }}</td>
                                <td>
                                    <span class="badge {{ $mouvement->type === 'entree' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $mouvement->type }}
                                    </span>
                                </td>
                                <td>{{ $mouvement->quantite }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Statistiques des mouvements -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Statistiques du mois</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <span class="badge badge-success p-2">Entrées</span>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $stats_mouvements['entree']->total_quantite ?? 0 }}</h4>
                                <small class="text-muted">{{ $stats_mouvements['entree']->total_mouvements ?? 0 }} mouvements</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <span class="badge badge-danger p-2">Sorties</span>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $stats_mouvements['sortie']->total_quantite ?? 0 }}</h4>
                                <small class="text-muted">{{ $stats_mouvements['sortie']->total_mouvements ?? 0 }} mouvements</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
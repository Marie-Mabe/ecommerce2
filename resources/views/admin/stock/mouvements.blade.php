@extends('admin.layout')

@section('title', 'Historique des mouvements')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Historique des mouvements - {{ $produit->libelle }}</h4>
                        <p class="card-description">
                            Stock actuel : 
                            <span class="badge badge-primary">{{ $produit->quantite }}</span>
                        </p>
                    </div>
                    <a href="{{ route('admin.stock.index') }}" class="btn btn-light">
                        <i class="ti-back-left"></i> Retour
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Quantité</th>
                                <th>Motif</th>
                                <th>Référence</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mouvements as $mouvement)
                            <tr>
                                <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($mouvement->type === 'entree')
                                        <span class="badge badge-success">Entrée</span>
                                    @else
                                        <span class="badge badge-danger">Sortie</span>
                                    @endif
                                </td>
                                <td>{{ $mouvement->quantite }}</td>
                                <td>{{ $mouvement->motif }}</td>
                                <td>{{ $mouvement->reference ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $mouvements->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
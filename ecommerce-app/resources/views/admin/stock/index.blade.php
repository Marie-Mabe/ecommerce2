@extends('admin.layout')

@section('title', 'Gestion des stocks')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">État des stocks</h4>
                    <a href="{{ route('admin.stock.alerte') }}" class="btn btn-warning">
                        <i class="ti-alert"></i> Voir les alertes de stock
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Stock actuel</th>
                                <th>État</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                            <tr>
                                <td>{{ $produit->libelle }}</td>
                                <td>{{ $produit->categorie->libelle }}</td>
                                <td>{{ $produit->quantite }}</td>
                                <td>
                                    @if($produit->quantite <= 0)
                                        <span class="badge badge-danger">Rupture</span>
                                    @elseif($produit->quantite <= 10)
                                        <span class="badge badge-warning">Stock faible</span>
                                    @else
                                        <span class="badge badge-success">En stock</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" 
                                            onclick="showAjustementModal('{{ $produit->id }}', '{{ $produit->libelle }}')">
                                        <i class="ti-plus"></i> Ajuster
                                    </button>
                                    <a href="{{ route('admin.stock.mouvements', $produit->id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="ti-eye"></i> Historique
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $produits->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajustement Stock -->
<div class="modal fade" id="ajustementModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="ajustementForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajuster le stock</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Type de mouvement</label>
                        <select name="type" class="form-control" required>
                            <option value="entree">Entrée</option>
                            <option value="sortie">Sortie</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantité</label>
                        <input type="number" name="quantite" class="form-control" required min="1">
                    </div>
                    <div class="form-group">
                        <label>Motif</label>
                        <input type="text" name="motif" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Référence (optionnel)</label>
                        <input type="text" name="reference" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function showAjustementModal(produitId, produitNom) {
    const form = document.getElementById('ajustementForm');
    form.action = `/admin/stock/${produitId}/ajuster`;
    
    const modal = document.getElementById('ajustementModal');
    const modalTitle = modal.querySelector('.modal-title');
    modalTitle.textContent = `Ajuster le stock - ${produitNom}`;
    
    $(modal).modal('show');
}
</script>
@endsection 
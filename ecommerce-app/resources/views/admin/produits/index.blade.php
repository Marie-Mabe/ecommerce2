@extends('admin.layout')

@section('title', 'Gestion des produits')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des produits</h4>
                <a href="{{ route('admin.produits.create') }}" class="btn btn-primary btn-icon-text">
                    <i class="ti-plus btn-icon-prepend"></i>
                    Ajouter
                </a>
                
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                            <tr>
                                <td><img src="{{ asset('storage/'.$produit->image) }}" width="50" alt=""></td>
                                <td>{{ $produit->libelle }}</td>
                                <td>{{ $produit->prixunit }} €</td>
                                <td>{{ $produit->quantite }}</td>
                                <td>
                                    <a href="{{ route('admin.produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti-pencil"></i> Modifier
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete('{{ $produit->id }}', '{{ $produit->libelle }}')">
                                        <i class="ti-trash"></i> Supprimer
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@section('scripts')
<script>
function confirmDelete(productId, productName) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: `Voulez-vous vraiment supprimer le produit "${productName}" ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = "{{ route('admin.produits.destroy', '') }}/" + productId;
            form.submit();
        }
    });
}
</script>
@endsection
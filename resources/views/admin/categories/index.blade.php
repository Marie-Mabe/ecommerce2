@extends('admin.layout')

@section('title', 'Gestion des catégories')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des catégories</h4>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-icon-text">
                    <i class="ti-plus btn-icon-prepend"></i>
                    Ajouter
                </a>
                
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Libellé</th>
                                <th>Description</th>
                                <th>Nombre de produits</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $categorie)
                            <tr>
                                <td>{{ $categorie->libelle }}</td>
                                <td>{{ $categorie->description }}</td>
                                <td>{{ $categorie->produits->count() }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti-pencil"></i> Modifier
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete('{{ $categorie->id }}', '{{ $categorie->libelle }}')">
                                        <i class="ti-trash"></i> Supprimer
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-3">
                        {{ $categories->links() }}
                    </div>
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
function confirmDelete(categoryId, categoryName) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: `Voulez-vous vraiment supprimer la catégorie "${categoryName}" ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = "{{ route('admin.categories.destroy', '') }}/" + categoryId;
            form.submit();
        }
    });
}
</script>
@endsection 
@extends('admin.layout')

@section('title', 'Gestion des fournisseurs')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Liste des fournisseurs</h4>
                    <a href="{{ route('admin.fournisseurs.create') }}" class="btn btn-primary">
                        <i class="ti-plus"></i> Nouveau fournisseur
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fournisseurs as $fournisseur)
                            <tr>
                                <td>{{ $fournisseur->nom }}</td>
                                <td>{{ $fournisseur->email }}</td>
                                <td>{{ $fournisseur->telephone }}</td>
                                <td>
                                    <span class="badge {{ $fournisseur->actif ? 'badge-success' : 'badge-danger' }}">
                                        {{ $fournisseur->actif ? 'Actif' : 'Inactif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.fournisseurs.show', $fournisseur->id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.fournisseurs.edit', $fournisseur->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete('{{ $fournisseur->id }}', '{{ $fournisseur->nom }}')">
                                        <i class="ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $fournisseurs->links() }}
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
function confirmDelete(fournisseurId, fournisseurNom) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: `Voulez-vous vraiment supprimer le fournisseur "${fournisseurNom}" ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = `{{ route('admin.fournisseurs.destroy', '') }}/${fournisseurId}`;
            form.submit();
        }
    });
}
</script>
@endsection 
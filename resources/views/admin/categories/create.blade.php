@extends('admin.layout')

@section('title', 'Ajouter une catégorie')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nouvelle catégorie</h4>
                
                <form id="createForm" action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    @include('admin.categories.partials.form-categorie')
                    
                    <div class="mt-3">
                        <button type="button" onclick="confirmCreate()" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                            <i class="ti-back-left"></i> Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmCreate() {
    Swal.fire({
        title: 'Confirmation',
        text: 'Voulez-vous vraiment ajouter cette catégorie ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, ajouter!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('createForm').submit();
        }
    });
}
</script>
@endsection 
@extends('admin.layout')

@section('title', 'Modifier la catégorie')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modification catégorie</h4>
                
                <form id="editForm" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    @include('admin.categories.partials.form-categorie')
                    
                    <div class="mt-3">
                        <button type="button" onclick="confirmUpdate()" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Mettre à jour
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
function confirmUpdate() {
    Swal.fire({
        title: 'Confirmation',
        text: 'Voulez-vous vraiment modifier cette catégorie ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, modifier!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('editForm').submit();
        }
    });
}
</script>
@endsection 
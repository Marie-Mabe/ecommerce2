@extends('admin.layout')

@section('title', 'Modifier le produit')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modification produit</h4>
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="editForm" action="{{ route('admin.produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @include('admin.produits.partials.form-produit')
                    
                    <div class="mt-3">
                        <button type="button" onclick="confirmUpdate()" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Mettre à jour
                        </button>
                        <a href="{{ route('admin.produits.index') }}" class="btn btn-light">
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
        text: 'Voulez-vous vraiment modifier ce produit ?',
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

function toggleDatePeremption(checkbox) {
    const dateGroup = document.getElementById('date_peremption_group');
    const dateInput = document.getElementById('date_peremption');
    
    if (checkbox.checked) {
        dateGroup.style.display = 'block';
        dateInput.setAttribute('required', 'required');
    } else {
        dateGroup.style.display = 'none';
        dateInput.removeAttribute('required');
        dateInput.value = '';
    }
}
</script>
@endsection
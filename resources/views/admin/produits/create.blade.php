@extends('admin.layout')

@section('title', 'Ajouter un produit')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un produit</h4>
                
                <form id="createForm" action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.produits.partials.form-produit')
                    
                    <div class="mt-3">
                        <button type="button" onclick="confirmCreate()" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Enregistrer
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
function confirmCreate() {
    Swal.fire({
        title: 'Confirmation',
        text: 'Voulez-vous vraiment ajouter ce produit ?',
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
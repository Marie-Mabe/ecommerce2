@extends('admin.layout')

@section('title', 'Nouveau fournisseur')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter un fournisseur</h4>
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="forms-sample" method="POST" action="{{ route('admin.fournisseurs.store') }}">
                    @csrf
                    
                    @include('admin.fournisseurs.partials.form')
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('admin.fournisseurs.index') }}" class="btn btn-light">
                            <i class="ti-back-left"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
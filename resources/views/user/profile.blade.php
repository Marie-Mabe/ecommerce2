@extends('user.navigation.layout')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>Mon Profil</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nom :</label>
                        <p class="form-control-plaintext">{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email :</label>
                        <p class="form-control-plaintext">{{ $user->email }}</p>
                    </div>
                    <!-- Ajoutez d'autres champs si nécessaire -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
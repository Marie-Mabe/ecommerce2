<div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
           id="nom" name="nom" value="{{ old('nom', $fournisseur->nom ?? '') }}" required>
    @error('nom')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" 
           id="email" name="email" value="{{ old('email', $fournisseur->email ?? '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="telephone">Téléphone</label>
    <input type="text" class="form-control @error('telephone') is-invalid @enderror" 
           id="telephone" name="telephone" value="{{ old('telephone', $fournisseur->telephone ?? '') }}" required>
    @error('telephone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="adresse">Adresse</label>
    <textarea class="form-control @error('adresse') is-invalid @enderror" 
              id="adresse" name="adresse" rows="3" required>{{ old('adresse', $fournisseur->adresse ?? '') }}</textarea>
    @error('adresse')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" 
              id="description" name="description" rows="4">{{ old('description', $fournisseur->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" 
               id="actif" name="actif" value="1" 
               {{ old('actif', $fournisseur->actif ?? true) ? 'checked' : '' }}>
        <label class="custom-control-label" for="actif">Fournisseur actif</label>
    </div>
</div> 
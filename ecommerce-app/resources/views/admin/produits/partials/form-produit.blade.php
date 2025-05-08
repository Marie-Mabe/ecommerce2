<div class="form-group">
    <label for="libelle">Libellé</label>
    <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror"
           value="{{ old('libelle', $produit->libelle ?? '') }}" required>
    @error('libelle')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="marque">Marque</label>
    <input type="text" name="marque" class="form-control @error('marque') is-invalid @enderror"
           value="{{ old('marque', $produit->marque ?? '') }}" required>
    @error('marque')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="prixunit">Prix unitaire</label>
    <input type="number" step="0.01" name="prixunit" class="form-control @error('prixunit') is-invalid @enderror"
           value="{{ old('prixunit', $produit->prixunit ?? '') }}" required>
    @error('prixunit')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="quantite">Quantité</label>
    <input type="number" name="quantite" class="form-control @error('quantite') is-invalid @enderror"
           value="{{ old('quantite', $produit->quantite ?? '') }}" required>
    @error('quantite')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="seuil_alerte">Seuil d'alerte stock</label>
    <input type="number" name="seuil_alerte" class="form-control @error('seuil_alerte') is-invalid @enderror"
           value="{{ old('seuil_alerte', $produit->seuil_alerte ?? 5) }}" 
           min="0" required>
    <small class="form-text text-muted">Vous serez alerté lorsque le stock atteindra ou passera sous ce seuil.</small>
    @error('seuil_alerte')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group form-check mb-3">
    <input type="checkbox" class="form-check-input" id="is_perissable" name="is_perissable"
           {{ old('date_peremption', $produit->date_peremption ?? '') ? 'checked' : '' }}
           onchange="toggleDatePeremption(this)">
    <label class="form-check-label" for="is_perissable">Produit périssable</label>
</div>

<div class="form-group" id="date_peremption_group" style="{{ old('date_peremption', $produit->date_peremption ?? '') ? '' : 'display: none;' }}">
    <label for="date_peremption">Date de péremption</label>
    <input type="date" name="date_peremption" id="date_peremption" 
           class="form-control @error('date_peremption') is-invalid @enderror"
           value="{{ old('date_peremption', $produit->date_peremption ?? '') }}">
    @error('date_peremption')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="id_categorie">Catégorie</label>
    <select name="id_categorie" class="form-control @error('id_categorie') is-invalid @enderror" required>
        <option value="">-- Sélectionner --</option>
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}"
                {{ old('id_categorie', $produit->id_categorie ?? '') == $categorie->id ? 'selected' : '' }}>
                {{ $categorie->libelle }}
            </option>
        @endforeach
    </select>
    @error('id_categorie')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="fournisseur_id">Fournisseur</label>
    <select name="fournisseur_id" class="form-control @error('fournisseur_id') is-invalid @enderror">
        <option value="">-- Sélectionner un fournisseur --</option>
        @foreach($fournisseurs as $fournisseur)
            <option value="{{ $fournisseur->id }}"
                {{ old('fournisseur_id', $produit->fournisseur_id ?? '') == $fournisseur->id ? 'selected' : '' }}>
                {{ $fournisseur->nom }}
            </option>
        @endforeach
    </select>
    @error('fournisseur_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="image">Image du produit</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    
    @if(isset($produit) && $produit->image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $produit->image) }}" alt="Image actuelle" width="120">
        </div>
    @endif

    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group form-check">
    <input type="checkbox" name="statut" value="1" class="form-check-input"
        {{ old('statut', $produit->statut ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="statut">Actif</label>
</div>

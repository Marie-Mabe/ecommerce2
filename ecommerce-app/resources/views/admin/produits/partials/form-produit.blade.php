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
    <label for="date_peremption">Date de péremption</label>
    <input type="date" name="date_peremption" class="form-control @error('date_peremption') is-invalid @enderror"
           value="{{ old('date_peremption', $produit->date_peremption ?? '') }}" required>
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

<div class="form-group">
    <label for="libelle">Libellé</label>
    <input type="text" name="libelle" id="libelle" 
           class="form-control @error('libelle') is-invalid @enderror"
           value="{{ old('libelle', $category->libelle ?? '') }}" required>
    @error('libelle')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4"
              class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> 
<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Cle *</label>
        <input type="text" name="key" value="{{ old('key', $siteSetting->key ?? '') }}" class="form-input" placeholder="hero" required>
        <span class="form-hint">Utilisez uniquement lettres, chiffres, point, tiret ou underscore.</span>
        @error('key') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Valeur</label>
        <textarea name="value" class="form-input">{{ old('value', $formattedValue ?? '') }}</textarea>
        <span class="form-hint">Vous pouvez enregistrer du texte simple ou un objet JSON.</span>
        @error('value') <span class="form-error">{{ $message }}</span> @enderror
    </div>
</div>

<div style="margin-top:1.5rem;display:flex;gap:.75rem;flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
    <a href="{{ route('admin.site-settings.index') }}" class="btn btn-secondary">Annuler</a>
</div>

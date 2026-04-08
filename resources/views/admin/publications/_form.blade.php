<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $publication->title ?? '') }}" class="form-input" required>
        @error('title') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Type *</label>
        <select name="type" class="form-select" required>
            @foreach(['statut' => 'Statut', 'reglement' => 'Reglement', 'article' => 'Article', 'annonce' => 'Annonce'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $publication->type ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('type') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Unite</label>
        <select name="scout_unit_id" class="form-select">
            <option value="">Toutes les unites</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" @selected((string) old('scout_unit_id', $publication->scout_unit_id ?? '') === (string) $unit->id)>{{ $unit->name }}</option>
            @endforeach
        </select>
        @error('scout_unit_id') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Auteur</label>
        <input type="text" name="author" value="{{ old('author', $publication->author ?? '') }}" class="form-input">
        @error('author') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Date de publication</label>
        <input type="date" name="publication_date" value="{{ old('publication_date', optional($publication->publication_date ?? null)->format('Y-m-d')) }}" class="form-input">
        @error('publication_date') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Ordre</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $publication->sort_order ?? 0) }}" class="form-input" min="0">
        @error('sort_order') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Extrait</label>
        <textarea name="excerpt" class="form-input">{{ old('excerpt', $publication->excerpt ?? '') }}</textarea>
        @error('excerpt') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Contenu</label>
        <textarea name="body" class="form-input">{{ old('body', $publication->body ?? '') }}</textarea>
        @error('body') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label style="display:flex;align-items:center;gap:.6rem;font-weight:600;">
            <input type="checkbox" name="is_published" value="1" class="toggle-input" @checked(old('is_published', $publication->is_published ?? true))>
            Publication visible sur le site
        </label>
    </div>
</div>

<div style="margin-top:1.5rem;display:flex;gap:.75rem;flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
    <a href="{{ route('admin.publications.index') }}" class="btn btn-secondary">Annuler</a>
</div>

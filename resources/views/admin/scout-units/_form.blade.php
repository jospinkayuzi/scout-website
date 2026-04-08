<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Nom *</label>
        <input type="text" name="name" value="{{ old('name', $scoutUnit->name ?? '') }}" class="form-input" required>
        @error('name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Slug *</label>
        <input type="text" name="slug" value="{{ old('slug', $scoutUnit->slug ?? '') }}" class="form-input" placeholder="meute" required>
        @error('slug') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Tranche d age *</label>
        <input type="text" name="age_range" value="{{ old('age_range', $scoutUnit->age_range ?? '') }}" class="form-input" placeholder="6 - 11 ans" required>
        @error('age_range') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Leader</label>
        <input type="text" name="leader_name" value="{{ old('leader_name', $scoutUnit->leader_name ?? '') }}" class="form-input">
        @error('leader_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Horaire</label>
        <input type="text" name="schedule" value="{{ old('schedule', $scoutUnit->schedule ?? '') }}" class="form-input">
        @error('schedule') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Public</label>
        <input type="text" name="gender_scope" value="{{ old('gender_scope', $scoutUnit->gender_scope ?? '') }}" class="form-input" placeholder="Mixte">
        @error('gender_scope') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Icone Font Awesome</label>
        <input type="text" name="icon" value="{{ old('icon', $scoutUnit->icon ?? '') }}" class="form-input" placeholder="fa-solid fa-paw">
        @error('icon') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Ordre</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $scoutUnit->sort_order ?? 0) }}" class="form-input" min="0">
        @error('sort_order') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Couleur</label>
        <input type="text" name="color" value="{{ old('color', $scoutUnit->color ?? '') }}" class="form-input" placeholder="#214b8f">
        @error('color') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Couleur d accent</label>
        <input type="text" name="accent_color" value="{{ old('accent_color', $scoutUnit->accent_color ?? '') }}" class="form-input" placeholder="#e8f0ff">
        @error('accent_color') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Description courte *</label>
        <textarea name="short_description" class="form-input" required>{{ old('short_description', $scoutUnit->short_description ?? '') }}</textarea>
        @error('short_description') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Description longue</label>
        <textarea name="long_description" class="form-input">{{ old('long_description', $scoutUnit->long_description ?? '') }}</textarea>
        @error('long_description') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label style="display:flex;align-items:center;gap:.6rem;font-weight:600;">
            <input type="checkbox" name="is_active" value="1" class="toggle-input" @checked(old('is_active', $scoutUnit->is_active ?? true))>
            Unite active sur le site public
        </label>
    </div>
</div>

<div style="margin-top:1.5rem;display:flex;gap:.75rem;flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
    <a href="{{ route('admin.scout-units.index') }}" class="btn btn-secondary">Annuler</a>
</div>

<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Unite concernee</label>
        <select name="scout_unit_id" class="form-select">
            <option value="">Toutes les unites</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" @selected((string) old('scout_unit_id', $programEvent->scout_unit_id ?? '') === (string) $unit->id)>{{ $unit->name }}</option>
            @endforeach
        </select>
        @error('scout_unit_id') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $programEvent->title ?? '') }}" class="form-input" required>
        @error('title') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Date *</label>
        <input type="date" name="event_date" value="{{ old('event_date', optional($programEvent->event_date ?? null)->format('Y-m-d')) }}" class="form-input" required>
        @error('event_date') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Horaire</label>
        <input type="text" name="time_label" value="{{ old('time_label', $programEvent->time_label ?? '') }}" class="form-input">
        @error('time_label') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Responsable</label>
        <input type="text" name="responsible" value="{{ old('responsible', $programEvent->responsible ?? '') }}" class="form-input">
        @error('responsible') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Lieu</label>
        <input type="text" name="location" value="{{ old('location', $programEvent->location ?? '') }}" class="form-input">
        @error('location') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Ordre</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $programEvent->sort_order ?? 0) }}" class="form-input" min="0">
        @error('sort_order') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-input">{{ old('description', $programEvent->description ?? '') }}</textarea>
        @error('description') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label style="display:flex;align-items:center;gap:.6rem;font-weight:600;">
            <input type="checkbox" name="is_public" value="1" class="toggle-input" @checked(old('is_public', $programEvent->is_public ?? true))>
            Visible sur le site public
        </label>
    </div>
</div>

<div style="margin-top:1.5rem;display:flex;gap:.75rem;flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
    <a href="{{ route('admin.program-events.index') }}" class="btn btn-secondary">Annuler</a>
</div>

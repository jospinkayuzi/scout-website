<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Titre *</label>
        <input type="text" name="title" value="{{ old('title', $galleryItem->title ?? '') }}" class="form-input" required>
        @error('title') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Type *</label>
        <select name="media_type" class="form-select" required>
            <option value="image" @selected(old('media_type', $galleryItem->media_type ?? 'image') === 'image')>Image</option>
            <option value="video" @selected(old('media_type', $galleryItem->media_type ?? '') === 'video')>Video</option>
        </select>
        @error('media_type') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Galerie / Unite</label>
        <select name="scout_unit_id" class="form-select">
            <option value="">Toutes les unites</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" @selected((string) old('scout_unit_id', $galleryItem->scout_unit_id ?? $selectedUnitId ?? '') === (string) $unit->id)>{{ $unit->name }}</option>
            @endforeach
        </select>
        <span class="form-hint">Le media sera publie dans la galerie de l unite choisie.</span>
        @error('scout_unit_id') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Nom de l evenement</label>
        <input type="text" name="event_name" value="{{ old('event_name', $galleryItem->event_name ?? '') }}" class="form-input">
        @error('event_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Uploader un fichier</label>
        <input type="file" name="media_file" class="form-input" accept="image/*,video/*">
        <span class="form-hint">Choisissez une photo ou une video depuis votre ordinateur. Taille max: 50 Mo.</span>
        @error('media_file') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Chemin ou URL du media</label>
        <input type="text" name="media_path" value="{{ old('media_path', $galleryItem->media_path ?? '') }}" class="form-input" placeholder="storage/gallery/images/photo.jpg ou https://...">
        <span class="form-hint">Optionnel si vous envoyez un fichier. Utile pour une URL externe ou un media deja present.</span>
        @error('media_path') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    @if(!empty($galleryItem?->media_path))
        <div class="form-group full">
            <label class="form-label">Media actuel</label>
            <div class="card" style="padding:1rem;border-radius:16px;">
                <div style="font-size:.82rem;color:var(--gray-500);margin-bottom:.75rem;">{{ $galleryItem->media_path }}</div>
                @if($galleryItem->media_type === 'video')
                    <video controls preload="metadata" style="max-width:100%;border-radius:12px;">
                        <source src="{{ \Illuminate\Support\Str::startsWith($galleryItem->media_path, ['http://', 'https://']) ? $galleryItem->media_path : asset($galleryItem->media_path) }}">
                    </video>
                @else
                    <img src="{{ \Illuminate\Support\Str::startsWith($galleryItem->media_path, ['http://', 'https://']) ? $galleryItem->media_path : asset($galleryItem->media_path) }}" alt="{{ $galleryItem->title }}" style="max-width:280px;border-radius:12px;">
                @endif
            </div>
        </div>
    @endif
    <div class="form-group">
        <label class="form-label">Date de prise</label>
        <input type="date" name="taken_at" value="{{ old('taken_at', optional($galleryItem->taken_at ?? null)->format('Y-m-d')) }}" class="form-input">
        @error('taken_at') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Ordre</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $galleryItem->sort_order ?? 0) }}" class="form-input" min="0">
        @error('sort_order') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Legende</label>
        <textarea name="caption" class="form-input">{{ old('caption', $galleryItem->caption ?? '') }}</textarea>
        @error('caption') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label style="display:flex;align-items:center;gap:.6rem;font-weight:600;">
            <input type="checkbox" name="is_featured" value="1" class="toggle-input" @checked(old('is_featured', $galleryItem->is_featured ?? true))>
            Mettre en avant sur le site
        </label>
    </div>
</div>

<div style="margin-top:1.5rem;display:flex;gap:.75rem;flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
    <a href="{{ route('admin.gallery-items.index') }}" class="btn btn-secondary">Annuler</a>
</div>

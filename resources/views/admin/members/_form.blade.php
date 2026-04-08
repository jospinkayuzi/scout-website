<div class="form-grid">
    <div class="form-group">
        <label class="form-label">Prenom *</label>
        <input type="text" name="first_name" value="{{ old('first_name', $member->first_name ?? '') }}" class="form-input" required>
        @error('first_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Nom *</label>
        <input type="text" name="last_name" value="{{ old('last_name', $member->last_name ?? '') }}" class="form-input" required>
        @error('last_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Unite *</label>
        <select name="scout_unit_id" class="form-select" required>
            <option value="">Choisir une unite</option>
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" @selected((string) old('scout_unit_id', $member->scout_unit_id ?? '') === (string) $unit->id)>{{ $unit->name }}</option>
            @endforeach
        </select>
        @error('scout_unit_id') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Statut *</label>
        <select name="status" class="form-select" required>
            @foreach(['active' => 'Actif', 'pending' => 'En attente', 'inactive' => 'Inactif'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $member->status ?? 'pending') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Date de naissance *</label>
        <input type="date" name="birth_date" value="{{ old('birth_date', optional($member->birth_date ?? null)->format('Y-m-d')) }}" class="form-input" required>
        @error('birth_date') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Date d inscription</label>
        <input type="date" name="registered_at" value="{{ old('registered_at', optional($member->registered_at ?? null)->format('Y-m-d')) }}" class="form-input">
        @error('registered_at') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $member->email ?? '') }}" class="form-input">
        @error('email') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Telephone</label>
        <input type="text" name="phone" value="{{ old('phone', $member->phone ?? '') }}" class="form-input">
        @error('phone') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Genre</label>
        <input type="text" name="gender" value="{{ old('gender', $member->gender ?? '') }}" class="form-input">
        @error('gender') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Fonction</label>
        <select name="member_function" class="form-select">
            <option value="">Choisir une fonction</option>
            @if(auth()->user()->hasRole('Super Admin'))
                <optgroup label="Maitrise">
                    <option value="Cheffe de Groupe" @selected(old('member_function', $member->member_function ?? '') === 'Cheffe de Groupe')>Cheffe de Groupe</option>
                    <option value="Assistant chef de groupe" @selected(old('member_function', $member->member_function ?? '') === 'Assistant chef de groupe')>Assistant chef de groupe</option>
                    <option value="Secrétaire" @selected(old('member_function', $member->member_function ?? '') === 'Secrétaire')>Secrétaire</option>
                    <option value="Trésorier(e)" @selected(old('member_function', $member->member_function ?? '') === 'Trésorier(e)')>Trésorier(e)</option>
                    <option value="Akela (Chef d'unité Meute)" @selected(old('member_function', $member->member_function ?? '') === 'Akela (Chef d\'unité Meute)')>Akela (Chef d'unité Meute)</option>
                    <option value="Baghera (Assistants)" @selected(old('member_function', $member->member_function ?? '') === 'Baghera (Assistants)')>Baghera (Assistants)</option>
                    <option value="Baloo" @selected(old('member_function', $member->member_function ?? '') === 'Baloo')>Baloo</option>
                    <option value="Troupe F" @selected(old('member_function', $member->member_function ?? '') === 'Troupe F')>Troupe F</option>
                    <option value="Troupe M" @selected(old('member_function', $member->member_function ?? '') === 'Troupe M')>Troupe M</option>
                    <option value="Grappe" @selected(old('member_function', $member->member_function ?? '') === 'Grappe')>Grappe</option>
                    <option value="Amical" @selected(old('member_function', $member->member_function ?? '') === 'Amical')>Amical</option>
                    <option value="Disciplinaire" @selected(old('member_function', $member->member_function ?? '') === 'Disciplinaire')>Disciplinaire</option>
                    <option value="Chargé du matériel" @selected(old('member_function', $member->member_function ?? '') === 'Chargé du matériel')>Chargé du matériel</option>
                    <option value="Chargée du social" @selected(old('member_function', $member->member_function ?? '') === 'Chargée du social')>Chargée du social</option>
                    <option value="Chargé de la communication" @selected(old('member_function', $member->member_function ?? '') === 'Chargé de la communication')>Chargé de la communication</option>
                    <option value="Animation du groupe" @selected(old('member_function', $member->member_function ?? '') === 'Animation du groupe')>Animation du groupe</option>
                    <option value="Chargé de la spiritualité" @selected(old('member_function', $member->member_function ?? '') === 'Chargé de la spiritualité')>Chargé de la spiritualité</option>
                    <option value="Chargé des projets, partenariats et développement du groupe" @selected(old('member_function', $member->member_function ?? '') === 'Chargé des projets, partenariats et développement du groupe')>Chargé des projets, partenariats et développement du groupe</option>
                    <option value="Chargé des événements et de l'expression des talents" @selected(old('member_function', $member->member_function ?? '') === 'Chargé des événements et de l\'expression des talents')>Chargé des événements et de l'expression des talents</option>
                </optgroup>
            @endif
            <option value="Membre" @selected(old('member_function', $member->member_function ?? 'Membre') === 'Membre')>Membre</option>
        </select>
        @error('member_function') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label class="form-label">Role / titre</label>
        <input type="text" name="role_title" value="{{ old('role_title', $member->role_title ?? '') }}" class="form-input">
        @error('role_title') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Adresse</label>
        <textarea name="address" class="form-input">{{ old('address', $member->address ?? '') }}</textarea>
        @error('address') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Parent / tuteur</label>
        <input type="text" name="parent_name" value="{{ old('parent_name', $member->parent_name ?? '') }}" class="form-input">
        @error('parent_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Informations medicales</label>
        <textarea name="medical_notes" class="form-input">{{ old('medical_notes', $member->medical_notes ?? '') }}</textarea>
        @error('medical_notes') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label class="form-label">Motivation</label>
        <textarea name="motivation" class="form-input">{{ old('motivation', $member->motivation ?? '') }}</textarea>
        @error('motivation') <span class="form-error">{{ $message }}</span> @enderror
    </div>
</div>

<div style="margin-top:1.5rem;display:flex;gap:.75rem;flex-wrap:wrap;">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Annuler</a>
</div>

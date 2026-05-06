@extends('site.layouts.app')

@section('title', 'Inscription - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Rejoindre le groupe')
@section('page_title', 'Formulaire d\'inscription')
@section('page_summary', 'Une inscription claire, guidee et adaptee aux nouvelles demandes du groupe, avec progression visuelle et validation immediate.')

@section('content')
@php
    $guardianRelationships = ['Pere', 'Mere', 'Frere / soeur', 'Oncle / tante', 'Grand-parent', 'Tuteur legal', 'Autre'];
@endphp
<section>
    <div class="section-shell">
        <article class="form-shell">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-fail">Le formulaire contient des erreurs. Verifiez les champs ci-dessous.</div>
            @endif

            <form method="POST" action="{{ route('members.register') }}" id="joinForm" novalidate>
                @csrf
                <div class="progress-shell" aria-live="polite">
                    <div class="progress-meta">
                        <div>
                            <div class="progress-label">Progression du formulaire</div>
                            <div class="progress-copy join-progress-copy" id="progressText">0 / 5 champs obligatoires</div>
                        </div>
                        <div class="progress-value" id="progressValue">0%</div>
                    </div>
                    <div class="progress-bar" aria-hidden="true">
                        <span class="progress-meter" id="progressMeter"></span>
                    </div>
                </div>

                <div class="form-grid">
                    <section class="form-section full">
                        <div class="form-section-head">
                            <div class="section-badge">Identite</div>
                            <h3>Les informations du futur scout</h3>
                            <p>Nom, prenom, totem et date de naissance pour orienter l inscription vers la bonne unite.</p>
                        </div>
                        <div class="form-grid section-grid">
                            <div class="form-group">
                                <label class="label" for="last_name">Nom *</label>
                                <input id="last_name" name="last_name" type="text" class="input" value="{{ old('last_name') }}" required>
                                @error('last_name')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="label" for="first_name">Prenom *</label>
                                <input id="first_name" name="first_name" type="text" class="input" value="{{ old('first_name') }}" required>
                                @error('first_name')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="label" for="totem">Totem <span class="totem-mark">&#9884;</span></label>
                                <div class="input-icon">
                                    <span class="input-icon-mark">&#9884;</span>
                                    <input id="totem" name="totem" type="text" class="input with-icon" value="{{ old('totem') }}">
                                </div>
                                @error('totem')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="label" for="birth_date">Date de naissance *</label>
                                <input id="birth_date" name="birth_date" type="date" class="input" value="{{ old('birth_date') }}" required>
                                @error('birth_date')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="label" for="gender">Genre *</label>
                                <select id="gender" name="gender" class="select" required>
                                    <option value="">Choisir</option>
                                    <option value="Feminin" @selected(old('gender') === 'Feminin')>Feminin</option>
                                    <option value="Masculin" @selected(old('gender') === 'Masculin')>Masculin</option>
                                </select>
                                @error('gender')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group full">
                                <label class="label" for="unit_name_preview">Ton unite *</label>
                                <input id="unit_name_preview" type="text" class="input" value="" placeholder="Complete la date de naissance pour voir ton unite" readonly>
                                <input id="scout_unit_id" name="scout_unit_id" type="hidden" value="{{ old('scout_unit_id') }}">
                                <select id="unit_source" class="select" hidden aria-hidden="true" tabindex="-1">
                                    <option value="">Choisir une unite</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" data-slug="{{ $unit->slug }}" @selected((string) old('scout_unit_id') === (string) $unit->id)>{{ $unit->name }} - {{ $unit->age_range }}</option>
                                    @endforeach
                                </select>
                                <span class="helper" id="unitSuggestion">Complete la date de naissance et le genre pour afficher automatiquement ton unite.</span>
                                @error('scout_unit_id')<span class="error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </section>

                    <section class="form-section full">
                        <div class="form-section-head">
                            <div class="section-badge">Coordonnees</div>
                            <h3>Pour rester en contact</h3>
                            <p>Adresse complete et numero de telephone du candidat.</p>
                        </div>
                        <div class="form-grid section-grid">
                            <div class="form-group full">
                                <label class="label" for="address">Adresse complete</label>
                                <input id="address" name="address" type="text" class="input" value="{{ old('address') }}">
                                @error('address')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group full">
                                <label class="label" id="phoneLabel" for="phone">Numero de telephone</label>
                                <input id="phone" name="phone" type="text" class="input" value="{{ old('phone') }}">
                                @error('phone')<span class="error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </section>

                    <section class="form-section full">
                        <div class="form-section-head">
                            <div class="section-badge">Parent ou tuteur</div>
                            <h3>Une personne de reference si necessaire</h3>
                            <p>Ces informations deviennent obligatoires pour les branches des plus jeunes.</p>
                        </div>
                        <div class="form-grid section-grid">
                            <div class="form-group full">
                                <label class="label" id="parentLabel" for="parent_name">Nom complet du parent ou tuteur</label>
                                <input id="parent_name" name="parent_name" type="text" class="input" value="{{ old('parent_name') }}">
                                @error('parent_name')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="label" id="guardianRelationshipLabel" for="guardian_relationship">Lien de parente</label>
                                <select id="guardian_relationship" name="guardian_relationship" class="select">
                                    <option value="">Choisir</option>
                                    @foreach($guardianRelationships as $relationship)
                                        <option value="{{ $relationship }}" @selected(old('guardian_relationship') === $relationship)>{{ $relationship }}</option>
                                    @endforeach
                                </select>
                                @error('guardian_relationship')<span class="error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="label" id="guardianPhoneLabel" for="guardian_phone">Telephone du tuteur</label>
                                <input id="guardian_phone" name="guardian_phone" type="text" class="input" value="{{ old('guardian_phone') }}">
                                @error('guardian_phone')<span class="error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </section>

                    <section class="form-section full">
                        <div class="form-section-head">
                            <div class="section-badge">Motivation</div>
                            <h3>Quelques mots pour nous parler de l envie de rejoindre le groupe</h3>
                            <p>Maximum 500 caracteres.</p>
                        </div>
                        <div class="form-grid section-grid">
                            <div class="form-group full">
                                <div class="counter-row">
                                    <label class="label" for="motivation">Motivation</label>
                                    <span class="helper" id="motivationCounter">0 / 500</span>
                                </div>
                                <textarea id="motivation" name="motivation" class="textarea" maxlength="500">{{ old('motivation') }}</textarea>
                                @error('motivation')<span class="error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </section>

                    <div class="form-group full submit-row">
                        <button type="submit" class="btn"><i class="fa-solid fa-fleur-de-lis"></i> Soumettre mon inscription</button>
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const joinForm = document.getElementById('joinForm');
    const birthDateInput = document.getElementById('birth_date');
    const unitInput = document.getElementById('scout_unit_id');
    const unitSource = document.getElementById('unit_source');
    const unitNamePreview = document.getElementById('unit_name_preview');
    const phoneLabel = document.getElementById('phoneLabel');
    const parentLabel = document.getElementById('parentLabel');
    const guardianRelationshipLabel = document.getElementById('guardianRelationshipLabel');
    const guardianPhoneLabel = document.getElementById('guardianPhoneLabel');
    const unitSuggestion = document.getElementById('unitSuggestion');
    const motivation = document.getElementById('motivation');
    const motivationCounter = document.getElementById('motivationCounter');
    const progressMeter = document.getElementById('progressMeter');
    const progressText = document.getElementById('progressText');
    const progressValue = document.getElementById('progressValue');
    const parentName = document.getElementById('parent_name');
    const guardianRelationship = document.getElementById('guardian_relationship');
    const guardianPhone = document.getElementById('guardian_phone');
    const gender = document.getElementById('gender');
    const phone = document.getElementById('phone');
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');

    function setRequiredState(field, label, baseText, required) {
        if (!field || !label) {
            return;
        }

        field.required = required;
        label.textContent = required ? `${baseText} *` : baseText;
    }

    function updateRequirements() {
        const selected = findSelectedUnitOption();
        const slug = selected?.dataset?.slug || '';
        const needsGuardian = ['meute', 'troupe-f', 'troupe-m', 'grappe'].includes(slug);
        const needsPhone = ['route', 'amical'].includes(slug);

        setRequiredState(phone, phoneLabel, 'Numero de telephone', needsPhone);
        setRequiredState(parentName, parentLabel, 'Nom complet du parent ou tuteur', needsGuardian);
        setRequiredState(guardianRelationship, guardianRelationshipLabel, 'Lien de parente', needsGuardian);
        setRequiredState(guardianPhone, guardianPhoneLabel, 'Telephone du tuteur', needsGuardian);
        updateProgress();
    }

    function calculateAgeFromBirthDate(value) {
        if (!value) {
            return null;
        }

        const today = new Date();
        const birthDate = new Date(value + 'T00:00:00');

        if (Number.isNaN(birthDate.getTime())) {
            return null;
        }

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age;
    }

    function findSelectedUnitOption() {
        return Array.from(unitSource?.options || []).find((option) => option.value === unitInput.value) || null;
    }

    function getAllowedUnitSlugs(age, selectedGender) {
        if (age === null) {
            return [];
        }

        if (age >= 6 && age <= 11) {
            return ['meute'];
        }

        if (age >= 12 && age <= 15) {
            if (selectedGender === 'Feminin') {
                return ['troupe-f'];
            }

            if (selectedGender === 'Masculin') {
                return ['troupe-m'];
            }

            return ['troupe-f', 'troupe-m'];
        }

        if (age >= 16 && age <= 18) {
            return ['grappe'];
        }

        if (age >= 19 && age <= 23) {
            return ['route'];
        }

        if (age > 23) {
            return ['amical'];
        }

        return [];
    }

    function findOptionBySlugs(slugs) {
        return Array.from(unitSource?.options || []).find((option) => slugs.includes(option.dataset.slug));
    }

    function applyUnitOption(option, message) {
        if (!option) {
            unitInput.value = '';
            unitNamePreview.value = '';
            unitNamePreview.placeholder = 'Aucune unite trouvee pour cet age';
            unitSuggestion.textContent = message;
            unitNamePreview.setCustomValidity('Selectionne une date de naissance et un genre valides pour afficher ton unite.');
            updateRequirements();
            return;
        }

        unitInput.value = option.value;
        unitNamePreview.value = option.textContent;
        unitNamePreview.setCustomValidity('');
        unitSuggestion.textContent = message;
        updateRequirements();
    }

    function clearUnitPreview(message, placeholder = 'Complete la date de naissance pour voir ton unite') {
        unitInput.value = '';
        unitNamePreview.value = '';
        unitNamePreview.placeholder = placeholder;
        unitNamePreview.setCustomValidity('Complete la date de naissance et le genre pour afficher ton unite.');
        unitSuggestion.textContent = message;
        updateRequirements();
    }

    function restoreUnitPreview() {
        const selected = findSelectedUnitOption();

        if (selected?.value) {
            unitInput.value = selected.value;
            unitNamePreview.value = selected.textContent;
            unitNamePreview.setCustomValidity('');
        } else {
            unitNamePreview.value = '';
            unitNamePreview.setCustomValidity('Complete la date de naissance et le genre pour afficher ton unite.');
        }
    }

    function suggestUnit() {
        const age = calculateAgeFromBirthDate(birthDateInput?.value);
        const selectedGender = gender?.value || '';
        const allowedSlugs = getAllowedUnitSlugs(age, selectedGender);

        if (age === null) {
            clearUnitPreview('Complete la date de naissance pour afficher automatiquement ton unite.');
            return;
        }

        if (allowedSlugs.length === 0) {
            clearUnitPreview('L age minimum recommande est de 6 ans.', 'Age inferieur a la tranche d inscription');
            return;
        }

        if (age >= 12 && age <= 15 && !selectedGender) {
            const previewOption = findOptionBySlugs(['troupe-f']) || findOptionBySlugs(['troupe-m']);
            if (previewOption) {
                unitNamePreview.value = 'Troupe F ou Troupe M';
            }

            unitInput.value = '';
            unitNamePreview.setCustomValidity('Choisis le genre pour afficher ton unite exacte.');
            unitSuggestion.textContent = 'Choisissez le genre pour afficher automatiquement Troupe F ou Troupe M.';
            updateRequirements();
            return;
        }

        const preferredOption = findOptionBySlugs(allowedSlugs);
        applyUnitOption(preferredOption, preferredOption ? `Ton unite est: ${preferredOption.textContent}.` : 'Aucune unite compatible avec cet age.');
    }

    function updateMotivationCounter() {
        const length = motivation?.value.length || 0;

        if (motivationCounter) {
            motivationCounter.textContent = `${length} / 500`;
        }
    }

    function isFieldCompleted(field) {
        if (!field || !field.required) {
            return false;
        }

        if (field === unitInput) {
            return field.value !== '';
        }

        if (field.tagName === 'SELECT') {
            return field.value !== '';
        }

        return field.value.trim() !== '';
    }

    function updateProgress() {
        const trackedFields = [lastName, firstName, birthDateInput, gender, unitInput, phone, parentName, guardianRelationship, guardianPhone]
            .filter(field => field?.required);

        const completedFields = trackedFields.filter(isFieldCompleted).length;
        const totalFields = trackedFields.length || 1;
        const percent = Math.round((completedFields / totalFields) * 100);

        progressMeter.style.width = `${percent}%`;
        progressValue.textContent = `${percent}%`;
        progressText.textContent = `${completedFields} / ${totalFields} champs obligatoires`;
    }

    function refreshSuggestedUnit() {
        suggestUnit();
        updateProgress();
    }

    birthDateInput?.addEventListener('input', refreshSuggestedUnit);
    birthDateInput?.addEventListener('change', refreshSuggestedUnit);
    gender?.addEventListener('input', refreshSuggestedUnit);
    gender?.addEventListener('change', refreshSuggestedUnit);
    [firstName, lastName, phone, parentName, guardianRelationship, guardianPhone].forEach((field) => {
        field?.addEventListener('input', updateProgress);
        field?.addEventListener('change', updateProgress);
    });
    motivation?.addEventListener('input', updateMotivationCounter);
    joinForm?.addEventListener('submit', (event) => {
        refreshSuggestedUnit();
        restoreUnitPreview();
        updateRequirements();
        updateProgress();

        if (!joinForm.reportValidity()) {
            event.preventDefault();
        }
    });

    restoreUnitPreview();
    updateRequirements();
    if (!unitInput?.value) {
        suggestUnit();
    }
    updateMotivationCounter();
    updateProgress();
</script>
@endpush

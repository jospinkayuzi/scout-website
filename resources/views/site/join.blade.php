@extends('site.layouts.app')

@section('title', 'Inscription - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Rejoindre le groupe')
@section('page_title', 'Formulaire d <span>inscription</span>')
@section('page_summary', 'Le formulaire a sa propre page pour offrir une experience plus simple, plus claire et moins chargee que dans une single page.')

@section('content')
<section>
    <div class="section-shell callout-grid">
        <article class="callout-card">
            <div class="section-head">
                <h2 class="section-title">Pourquoi <span>nous rejoindre</span></h2>
                <p class="section-copy">Le formulaire enregistre maintenant les demandes d inscription dans la base de donnees. L equipe admin peut ensuite les suivre, les mettre a jour et les valider depuis le dashboard.</p>
            </div>
            <div class="card-grid">
                @foreach($units as $unit)
                    <article class="info-card">
                        <div class="card-title">{{ $unit->name }}</div>
                        <p class="card-copy">{{ $unit->short_description }}</p>
                        <div class="meta-row">
                            <span class="pill">{{ $unit->age_range }}</span>
                            @if($unit->schedule)
                                <span class="pill">{{ $unit->schedule }}</span>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </article>

        <article class="form-shell">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-fail">Le formulaire contient des erreurs. Verifiez les champs ci-dessous.</div>
            @endif

            <form method="POST" action="{{ route('members.register') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label class="label" for="first_name">Prenom *</label>
                        <input id="first_name" name="first_name" type="text" class="input" value="{{ old('first_name') }}" required>
                        @error('first_name')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="label" for="last_name">Nom *</label>
                        <input id="last_name" name="last_name" type="text" class="input" value="{{ old('last_name') }}" required>
                        @error('last_name')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="label" for="birth_date">Date de naissance *</label>
                        <input id="birth_date" name="birth_date" type="date" class="input" value="{{ old('birth_date') }}" required>
                        <span class="helper" id="unitSuggestion">L unite peut etre suggeree selon l age.</span>
                        @error('birth_date')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="label" for="gender">Genre</label>
                        <select id="gender" name="gender" class="select">
                            <option value="">Choisir</option>
                            <option value="Feminin" @selected(old('gender') === 'Feminin')>Feminin</option>
                            <option value="Masculin" @selected(old('gender') === 'Masculin')>Masculin</option>
                        </select>
                        @error('gender')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group full">
                        <label class="label" for="scout_unit_id">Unite *</label>
                        <select id="scout_unit_id" name="scout_unit_id" class="select" required>
                            <option value="">Choisir une unite</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" data-slug="{{ $unit->slug }}" @selected((string) old('scout_unit_id') === (string) $unit->id)>{{ $unit->name }} - {{ $unit->age_range }}</option>
                            @endforeach
                        </select>
                        @error('scout_unit_id')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="label" id="phoneLabel" for="phone">Telephone</label>
                        <input id="phone" name="phone" type="text" class="input" value="{{ old('phone') }}">
                        @error('phone')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="label" for="email">Email</label>
                        <input id="email" name="email" type="email" class="input" value="{{ old('email') }}">
                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group full">
                        <label class="label" for="address">Adresse</label>
                        <input id="address" name="address" type="text" class="input" value="{{ old('address') }}">
                        @error('address')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group full">
                        <label class="label" id="parentLabel" for="parent_name">Parent / tuteur</label>
                        <input id="parent_name" name="parent_name" type="text" class="input" value="{{ old('parent_name') }}">
                        @error('parent_name')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group full">
                        <label class="label" for="medical_notes">Informations medicales</label>
                        <textarea id="medical_notes" name="medical_notes" class="textarea">{{ old('medical_notes') }}</textarea>
                        @error('medical_notes')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group full">
                        <label class="label" for="motivation">Motivation</label>
                        <textarea id="motivation" name="motivation" class="textarea">{{ old('motivation') }}</textarea>
                        @error('motivation')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group full">
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
    const birthDate = document.getElementById('birth_date');
    const unitSelect = document.getElementById('scout_unit_id');
    const phoneLabel = document.getElementById('phoneLabel');
    const parentLabel = document.getElementById('parentLabel');
    const unitSuggestion = document.getElementById('unitSuggestion');

    function updateRequirements() {
        const selected = unitSelect.options[unitSelect.selectedIndex];
        const slug = selected?.dataset?.slug || '';
        phoneLabel.textContent = ['route', 'amical'].includes(slug) ? 'Telephone *' : 'Telephone';
        parentLabel.textContent = ['meute', 'troupe-f', 'troupe-m', 'grappe'].includes(slug) ? 'Parent / tuteur *' : 'Parent / tuteur';
    }

    function suggestUnit() {
        if (!birthDate.value) {
            unitSuggestion.textContent = 'L unite peut etre suggeree selon l age.';
            return;
        }

        const today = new Date();
        const dob = new Date(birthDate.value + 'T00:00:00');
        let age = today.getFullYear() - dob.getFullYear();
        const monthGap = today.getMonth() - dob.getMonth();

        if (monthGap < 0 || (monthGap === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (age >= 6 && age <= 11) unitSuggestion.textContent = 'Suggestion: Meute';
        else if (age >= 12 && age <= 15) unitSuggestion.textContent = 'Suggestion: Troupe F ou Troupe M';
        else if (age >= 16 && age <= 18) unitSuggestion.textContent = 'Suggestion: Grappe';
        else if (age >= 19 && age <= 23) unitSuggestion.textContent = 'Suggestion: Route';
        else if (age > 23) unitSuggestion.textContent = 'Suggestion: Amical';
        else unitSuggestion.textContent = 'L age minimum recommande est de 6 ans.';
    }

    unitSelect?.addEventListener('change', updateRequirements);
    birthDate?.addEventListener('change', suggestUnit);
    updateRequirements();
    suggestUnit();
</script>
@endpush

@extends('admin.layouts.app')

@section('title', "Contenu de l'accueil")
@section('breadcrumb')
<a href="{{ route('admin.site-settings.index') }}">Parametres</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Accueil
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-house"></i> Contenu de l'accueil</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Le superadmin peut modifier ici les textes visibles sur l'accueil: hero, mission, valeurs, objectifs et contact.</p>
        </div>
    </div>
    <div class="card-body padded">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.site-settings.homepage.update') }}" style="display:grid;gap:1.2rem;">
            @csrf
            @method('PUT')

            <div class="card" style="border:1px solid var(--gray-200);box-shadow:none;">
                <div class="card-header"><h3><i class="fa-solid fa-bullhorn"></i> Hero</h3></div>
                <div class="card-body padded">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Badge</label>
                            <input type="text" name="hero[badge]" value="{{ old('hero.badge', $content['hero']['badge'] ?? '') }}" class="form-input">
                            @error('hero.badge') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Titre principal</label>
                            <input type="text" name="hero[title]" value="{{ old('hero.title', $content['hero']['title'] ?? '') }}" class="form-input">
                            @error('hero.title') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mot en evidence</label>
                            <input type="text" name="hero[highlight]" value="{{ old('hero.highlight', $content['hero']['highlight'] ?? '') }}" class="form-input">
                            @error('hero.highlight') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Bouton principal</label>
                            <input type="text" name="hero[primary_cta]" value="{{ old('hero.primary_cta', $content['hero']['primary_cta'] ?? '') }}" class="form-input">
                            @error('hero.primary_cta') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Bouton secondaire</label>
                            <input type="text" name="hero[secondary_cta]" value="{{ old('hero.secondary_cta', $content['hero']['secondary_cta'] ?? '') }}" class="form-input">
                            @error('hero.secondary_cta') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group full">
                            <label class="form-label">Description</label>
                            <textarea name="hero[description]" class="form-input" rows="4">{{ old('hero.description', $content['hero']['description'] ?? '') }}</textarea>
                            @error('hero.description') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border:1px solid var(--gray-200);box-shadow:none;">
                <div class="card-header"><h3><i class="fa-solid fa-compass-drafting"></i> Mission</h3></div>
                <div class="card-body padded">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label class="form-label">Sous-titre</label>
                            <input type="text" name="mission[subtitle]" value="{{ old('mission.subtitle', $content['mission']['subtitle'] ?? '') }}" class="form-input">
                            @error('mission.subtitle') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group full">
                            <label class="form-label">Texte principal</label>
                            <textarea name="mission[text]" class="form-input" rows="5">{{ old('mission.text', $content['mission']['text'] ?? '') }}</textarea>
                            @error('mission.text') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="border:1px solid var(--gray-200);box-shadow:none;">
                <div class="card-header"><h3><i class="fa-solid fa-heart"></i> Valeurs</h3></div>
                <div class="card-body padded">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label class="form-label">Sous-titre des valeurs</label>
                            <input type="text" name="values[subtitle]" value="{{ old('values.subtitle', $content['values']['subtitle'] ?? '') }}" class="form-input">
                            @error('values.subtitle') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div style="display:grid;gap:1rem;">
                        @foreach(($content['values']['items'] ?? []) as $index => $item)
                            <div style="padding:1rem;border:1px solid var(--gray-200);border-radius:16px;background:var(--white);display:grid;gap:1rem;">
                                <strong style="color:var(--gray-900);">Valeur {{ $index + 1 }}</strong>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Titre</label>
                                        <input type="text" name="values[items][{{ $index }}][title]" value="{{ old("values.items.$index.title", $item['title'] ?? '') }}" class="form-input">
                                        @error("values.items.$index.title") <span class="form-error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group full">
                                        <label class="form-label">Description</label>
                                        <textarea name="values[items][{{ $index }}][description]" class="form-input" rows="3">{{ old("values.items.$index.description", $item['description'] ?? '') }}</textarea>
                                        @error("values.items.$index.description") <span class="form-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card" style="border:1px solid var(--gray-200);box-shadow:none;">
                <div class="card-header"><h3><i class="fa-solid fa-bullseye"></i> Objectifs</h3></div>
                <div class="card-body padded">
                    <div class="form-grid">
                        <div class="form-group full">
                            <label class="form-label">Sous-titre des objectifs</label>
                            <input type="text" name="objectives[subtitle]" value="{{ old('objectives.subtitle', $content['objectives']['subtitle'] ?? '') }}" class="form-input">
                            @error('objectives.subtitle') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-grid">
                        @foreach(($content['objectives']['items'] ?? []) as $index => $item)
                            <div class="form-group">
                                <label class="form-label">Objectif {{ $index + 1 }}</label>
                                <input type="text" name="objectives[items][{{ $index }}][title]" value="{{ old("objectives.items.$index.title", is_array($item) ? ($item['title'] ?? '') : $item) }}" class="form-input">
                                @error("objectives.items.$index.title") <span class="form-error">{{ $message }}</span> @enderror
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card" style="border:1px solid var(--gray-200);box-shadow:none;">
                <div class="card-header"><h3><i class="fa-solid fa-address-book"></i> Contact</h3></div>
                <div class="card-body padded">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="contact[email]" value="{{ old('contact.email', $content['contact']['email'] ?? '') }}" class="form-input">
                            @error('contact.email') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Telephone</label>
                            <input type="text" name="contact[phone]" value="{{ old('contact.phone', $content['contact']['phone'] ?? '') }}" class="form-input">
                            @error('contact.phone') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group full">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="contact[address]" value="{{ old('contact.address', $content['contact']['address'] ?? '') }}" class="form-input">
                            @error('contact.address') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Enregistrer le contenu</button>
                <a href="{{ route('admin.site-settings.index') }}" class="btn btn-secondary">Retour aux parametres</a>
                <a href="{{ route('admin.scout-units.index') }}" class="btn btn-secondary">Gerer les unites</a>
            </div>
        </form>
    </div>
</div>
@endsection

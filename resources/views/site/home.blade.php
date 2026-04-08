@extends('site.layouts.app')

@section('title', 'Accueil - Groupe Scout Saint Nicolas')

@push('styles')
<style>
    .featured-units-spotlight {
        position: relative;
        overflow: hidden;
        padding: 1.8rem;
        border-radius: 32px;
        border: 1px solid rgba(32, 64, 128, .10);
        background:
            radial-gradient(circle at top left, rgba(255, 224, 32, .18), transparent 20%),
            linear-gradient(135deg, rgba(16, 21, 76, .98) 0%, rgba(24, 38, 108, .96) 52%, rgba(34, 75, 143, .92) 100%);
        box-shadow: 0 32px 70px rgba(10, 22, 44, .18);
    }
    .featured-units-spotlight::after {
        content: '';
        position: absolute;
        inset: auto -10% -32% auto;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, .18) 0%, rgba(255, 255, 255, 0) 72%);
        pointer-events: none;
    }
    .featured-units-shell {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(0, .9fr) minmax(0, 1.2fr);
        gap: 1.4rem;
        align-items: start;
    }
    .featured-units-intro {
        display: grid;
        gap: 1.25rem;
        color: var(--white);
    }
    .unit-spotlight-kicker {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        width: fit-content;
        padding: .5rem .9rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, .10);
        border: 1px solid rgba(255, 255, 255, .14);
        color: rgba(255, 255, 255, .84);
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }
    .featured-units-intro .section-title {
        color: var(--white);
    }
    .featured-units-intro .section-copy,
    .featured-units-lead {
        color: rgba(255, 255, 255, .76);
        max-width: 560px;
    }
    .featured-units-lead {
        line-height: 1.8;
        font-size: .96rem;
    }
    .featured-units-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .8rem;
    }
    .featured-units-stat {
        padding: 1rem;
        border-radius: 22px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .10);
        backdrop-filter: blur(10px);
    }
    .featured-units-stat strong {
        display: block;
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.7rem;
        color: var(--gold-300);
    }
    .featured-units-stat span {
        display: block;
        margin-top: .32rem;
        font-size: .78rem;
        line-height: 1.5;
        color: rgba(255, 255, 255, .72);
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 700;
    }
    .featured-units-highlight {
        padding: 1.05rem 1.15rem;
        border-radius: 24px;
        background: linear-gradient(180deg, rgba(255, 255, 255, .12), rgba(255, 255, 255, .07));
        border: 1px solid rgba(255, 255, 255, .12);
    }
    .featured-units-highlight span {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        color: var(--gold-300);
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }
    .featured-units-highlight strong {
        display: block;
        margin-top: .65rem;
        color: var(--white);
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.05rem;
    }
    .featured-units-highlight p {
        margin-top: .45rem;
        color: rgba(255, 255, 255, .72);
        line-height: 1.65;
        font-size: .9rem;
    }
    .featured-units-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .8rem;
        margin-top: .2rem;
    }
    .featured-units-actions .btn-outline {
        border-color: rgba(255, 255, 255, .22);
        color: var(--white);
        background: rgba(255, 255, 255, .05);
    }
    .featured-units-list {
        display: grid;
        gap: 1rem;
    }
    .featured-unit-card {
        position: relative;
        overflow: hidden;
        padding: 1.25rem;
        border-radius: 26px;
        background: rgba(255, 255, 255, .97);
        border: 1px solid rgba(255, 255, 255, .14);
        box-shadow: 0 18px 38px rgba(7, 20, 40, .14);
    }
    .featured-unit-card::before {
        content: '';
        position: absolute;
        inset: 0 auto 0 0;
        width: 5px;
        background: linear-gradient(180deg, var(--unit-color), var(--unit-accent));
    }
    .featured-unit-topline,
    .featured-unit-head,
    .featured-unit-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }
    .featured-unit-topline {
        margin-bottom: 1rem;
    }
    .featured-unit-order,
    .featured-unit-tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        font-size: .74rem;
        font-weight: 800;
        letter-spacing: .04em;
    }
    .featured-unit-order {
        min-width: 46px;
        min-height: 32px;
        padding: 0 .8rem;
        background: rgba(16, 21, 76, .06);
        color: var(--navy-900);
    }
    .featured-unit-tag {
        padding: .45rem .78rem;
        background: var(--unit-accent);
        color: var(--unit-color);
        text-transform: uppercase;
    }
    .featured-unit-brand {
        display: flex;
        align-items: center;
        gap: 1rem;
        min-width: 0;
    }
    .featured-unit-icon {
        margin-bottom: 0;
        flex-shrink: 0;
        box-shadow: inset 0 0 0 1px rgba(16, 21, 76, .05);
    }
    .featured-unit-subtitle {
        margin-top: .28rem;
        color: var(--ink-500);
        font-size: .84rem;
        font-weight: 700;
    }
    .featured-unit-count {
        text-align: right;
        flex-shrink: 0;
    }
    .featured-unit-count strong {
        display: block;
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.7rem;
        line-height: 1;
        color: var(--navy-950);
    }
    .featured-unit-count span {
        display: block;
        margin-top: .35rem;
        color: var(--ink-500);
        font-size: .77rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        font-weight: 700;
    }
    .featured-unit-card .card-copy {
        margin-top: 1rem;
    }
    .featured-unit-meta {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .75rem;
        margin-top: 1rem;
    }
    .featured-unit-meta-item {
        padding: .9rem;
        border-radius: 18px;
        background: linear-gradient(180deg, #fbfcff 0%, #f4f7ff 100%);
        border: 1px solid rgba(212, 220, 243, .92);
    }
    .featured-unit-meta-item span {
        display: block;
        color: var(--ink-500);
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .07em;
        font-weight: 800;
    }
    .featured-unit-meta-item strong {
        display: block;
        margin-top: .38rem;
        color: var(--navy-950);
        line-height: 1.5;
        font-size: .92rem;
    }
    .featured-unit-note {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        margin-top: 1rem;
        padding: .7rem .9rem;
        border-radius: 16px;
        background: rgba(16, 21, 76, .04);
        color: var(--navy-900);
        font-size: .84rem;
        font-weight: 700;
    }
    .featured-unit-note i {
        color: var(--unit-color);
    }
    @media (max-width: 1080px) {
        .featured-units-shell {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 720px) {
        .featured-units-spotlight {
            padding: 1.2rem;
            border-radius: 24px;
        }
        .featured-units-stats,
        .featured-unit-meta {
            grid-template-columns: 1fr;
        }
        .featured-unit-head {
            align-items: flex-start;
            flex-direction: column;
        }
        .featured-unit-count {
            text-align: left;
        }
    }
</style>
@endpush



@section('hero')
<section class="hero-home">
    <div class="hero-grid" style="grid-template-columns:1fr;max-width:980px;margin-inline:auto;">
        <div class="hero-copy" style="text-align:center;display:flex;flex-direction:column;align-items:center;">
            <img src="{{ asset('images/logo-gsn.png') }}" alt="Logo Groupe Scout Saint Nicolas" style="width:190px;height:190px;object-fit:contain;margin:0 auto 1.4rem;filter:drop-shadow(0 18px 34px rgba(16,21,76,.34));">
            <div class="eyebrow"><i class="fa-solid fa-fleur-de-lis"></i> {{ $hero['badge'] ?? 'Service - Fraternite - Honneur' }}</div>
            <h1 class="hero-title">{{ $hero['title'] ?? 'Groupe Scout' }} <span>{{ $hero['highlight'] ?? 'Saint Nicolas' }}</span></h1>
            <p style="max-width:720px;">{{ $hero['description'] ?? '' }}</p>
            <div class="hero-actions" style="justify-content:center;">
                <a href="{{ route('site.join') }}" class="btn"><i class="fa-solid fa-user-plus"></i> {{ $hero['primary_cta'] ?? 'Rejoindre le groupe' }}</a>
                <a href="{{ route('site.units') }}" class="btn-outline"><i class="fa-solid fa-compass"></i> {{ $hero['secondary_cta'] ?? 'Decouvrir nos unites' }}</a>
            </div>
            <div class="hero-panel" style="width:100%;max-width:920px;margin-top:2rem;">
                <div class="card-title" style="color:#fff;text-align:center;">Une plateforme plus claire pour les familles, les chefs et les membres.</div>
                <p class="card-copy" style="color:rgba(255,255,255,.72);margin-top:.6rem;text-align:center;">Le site n est plus une single page. Chaque espace a maintenant sa propre page, avec des contenus dynamiques relies a Laravel.</p>
                <div class="hero-panel-grid" style="margin-top:1.4rem;">
                    <div class="hero-metric"><strong>{{ $siteStats['members_active'] }}</strong><span>Membres actifs suivis dans la base de donnees</span></div>
                    <div class="hero-metric"><strong>{{ $siteStats['units'] }}</strong><span>Unites organisees avec leur programme</span></div>
                    <div class="hero-metric"><strong>{{ $siteStats['publications'] }}</strong><span>Documents et publications accessibles</span></div>
                    <div class="hero-metric"><strong>{{ $siteStats['events'] }}</strong><span>Evenements publics a venir</span></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
@php
    $featuredUnitsCount = $featuredUnits->count();
    $featuredActiveMembers = $featuredUnits->sum('active_members_count');
    $featuredPublicEvents = $featuredUnits->sum(fn ($unit) => $unit->relationLoaded('programEvents') ? $unit->programEvents->count() : 0);
    $nextFeaturedEvent = $featuredUnits
        ->flatMap(fn ($unit) => $unit->relationLoaded('programEvents') ? $unit->programEvents : collect())
        ->sortBy('event_date')
        ->first();
@endphp

<section>
    <div class="section-shell">
        <div class="featured-units-spotlight">
            <div class="featured-units-shell">
                <div class="featured-units-intro">
                    <div class="unit-spotlight-kicker"><i class="fa-solid fa-shield-heart"></i> Unites encadrees et actives</div>
                    <div class="section-head">
                        <h2 class="section-title">Toutes nos <span>unites</span></h2>
                        <p class="section-copy">Chaque branche suit un parcours clair, avec son responsable, son rythme d activites et ses objectifs educatifs.</p>
                    </div>
                    <p class="featured-units-lead">Decouvrez toutes nos unites avec leur programme du samedi pour une vue d'ensemble complete.</p>
                    <div class="featured-units-stats">
                        <div class="featured-units-stat">
                            <strong>{{ $featuredUnitsCount }}</strong>
                            <span>Unites actives</span>
                        </div>
                        <div class="featured-units-stat">
                            <strong>{{ $featuredActiveMembers }}</strong>
                            <span>Membres actifs</span>
                        </div>
                        <div class="featured-units-stat">
                            <strong>{{ $featuredPublicEvents }}</strong>
                            <span>Activites samedi</span>
                        </div>
                    </div>
                    @if($nextFeaturedEvent)
                        <div class="featured-units-highlight">
                            <span><i class="fa-solid fa-calendar-days"></i> Prochaine activite samedi</span>
                            <strong>{{ $nextFeaturedEvent->title }} - {{ $nextFeaturedEvent->event_date->format('d/m/Y') }}</strong>
                            <p>{{ $nextFeaturedEvent->scoutUnit->name ?? 'Toutes les unites' }} @if($nextFeaturedEvent->location) - {{ $nextFeaturedEvent->location }} @endif</p>
                        </div>
                    @endif
                    <div class="featured-units-actions">
                        <a href="{{ route('site.units') }}" class="btn"><i class="fa-solid fa-compass"></i> Voir toutes les unites</a>
                        <a href="{{ route('site.join') }}" class="btn-outline"><i class="fa-solid fa-user-plus"></i> Demander une inscription</a>
                    </div>
                </div>

                <div class="featured-units-list">
                    @forelse($featuredUnits as $index => $unit)
                        @php
                            $unitColor = $unit->color ?: '#214b8f';
                            $unitAccent = $unit->accent_color ?: 'rgba(33, 75, 143, .12)';
                            $nextUnitEvent = $unit->relationLoaded('programEvents') ? $unit->programEvents->first() : null;
                        @endphp
                        <article class="featured-unit-card" style="--unit-color: {{ $unitColor }}; --unit-accent: {{ $unitAccent }};">
                            <div class="featured-unit-head">
                                <div class="featured-unit-brand">
                                    <div class="card-icon featured-unit-icon" style="background:{{ $unitAccent }};color:{{ $unitColor }};">
                                        <i class="{{ $unit->icon ?: 'fa-solid fa-tent' }}"></i>
                                    </div>
                                    <div>
                                        <div class="card-title">{{ $unit->name }}</div>
                                        <div class="featured-unit-subtitle">{{ $unit->age_range ?: 'Parcours scout' }}</div>
                                    </div>
                                </div>
                                <div class="featured-unit-count">
                                    <strong>{{ $unit->active_members_count ?? 0 }}</strong>
                                    <span>Membres actifs</span>
                                </div>
                            </div>

                            <p class="card-copy">{{ $unit->short_description }}</p>

                            @if($nextUnitEvent)
                                <div class="featured-unit-note">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span>{{ $nextUnitEvent->title }} - {{ $nextUnitEvent->event_date->format('d/m/Y') }} @if($nextUnitEvent->time_label) - {{ $nextUnitEvent->time_label }} @endif</span>
                                </div>
                            @else
                                <div class="featured-unit-note">
                                    <i class="fa-solid fa-info-circle"></i>
                                    <span>Programme samedi a definir</span>
                                </div>
                            @endif
                        </article>
                    @empty
                        <div class="empty-state">Aucune unite n est encore disponible.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<section id="a-propos">
    <div class="section-shell callout-grid">
        <article class="callout-card">
            <div class="section-head">
                <h2 class="section-title">Mission et <span>education</span></h2>
                <p class="section-copy">{{ $mission['subtitle'] ?? '' }}</p>
            </div>
            <p class="card-copy" style="margin-top:0;">{{ $mission['text'] ?? '' }}</p>
            <div class="meta-row">
                @foreach(array_slice($objectives['items'] ?? [], 0, 3) as $objective)
                    <span class="pill"><i class="fa-solid fa-circle-check"></i> {{ $objective }}</span>
                @endforeach
            </div>
        </article>

        <article class="callout-card">
            <div class="card-title">Impact actuel</div>
            <div class="timeline">
                <div class="timeline-item"><div class="card-title" style="font-size:1rem;">{{ $siteStats['members_active'] }} membres actifs</div><p class="meta-copy">Jeunes et adultes engages dans la vie du groupe.</p></div>
                <div class="timeline-item"><div class="card-title" style="font-size:1rem;">{{ $siteStats['units'] }} unites</div><p class="meta-copy">Parcours differencies selon l age et le rythme de progression.</p></div>
                <div class="timeline-item"><div class="card-title" style="font-size:1rem;">{{ $siteStats['events'] }} rendez-vous a venir</div><p class="meta-copy">Programme public mis a jour depuis l administration.</p></div>
            </div>
        </article>
    </div>
</section>

<section>
    <div class="section-shell">
        <div class="section-head">
            <h2 class="section-title">Nos <span>valeurs</span></h2>
            <p class="section-copy">{{ $values['subtitle'] ?? '' }}</p>
        </div>
        <div class="card-grid">
            @foreach($values['items'] ?? [] as $value)
                <article class="info-card">
                    <div class="card-icon" style="background:{{ $value['background'] ?? 'rgba(33, 75, 143, .12)' }};color:{{ $value['color'] ?? '#214b8f' }};">
                        <i class="{{ $value['icon'] ?? 'fa-solid fa-star' }}"></i>
                    </div>
                    <div class="card-title">{{ $value['title'] ?? '' }}</div>
                    <p class="card-copy">{{ $value['description'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section>
    <div class="section-shell">
        <div class="section-head">
            <h2 class="section-title">Nos <span>objectifs</span></h2>
            <p class="section-copy">{{ $objectives['subtitle'] ?? '' }}</p>
        </div>
        <div class="card-grid">
            @foreach($objectives['items'] ?? [] as $objective)
                <article class="info-card">
                    <div class="card-icon" style="background:{{ $objective['background'] ?? 'rgba(33, 75, 143, .12)' }};color:{{ $objective['color'] ?? '#214b8f' }};">
                        <i class="{{ $objective['icon'] ?? 'fa-solid fa-circle-check' }}"></i>
                    </div>
                    <div class="card-title">{{ $objective['title'] ?? $objective }}</div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section>
    <div class="section-shell callout-grid">
        <article class="callout-card">
            <div class="card-title">Evenements a venir</div>
            <div class="timeline">
                @forelse($upcomingEvents as $event)
                    <div class="timeline-item">
                        <div class="timeline-date"><i class="fa-solid fa-calendar-days"></i> {{ $event->event_date->format('d/m/Y') }}</div>
                        <div class="card-title" style="font-size:1rem;margin-top:.45rem;">{{ $event->title }}</div>
                        <p class="meta-copy">{{ $event->scoutUnit->name ?? 'Toutes les unites' }} @if($event->location) - {{ $event->location }} @endif</p>
                    </div>
                @empty
                    <div class="empty-state">Aucun evenement public n est encore planifie.</div>
                @endforelse
            </div>
        </article>
    </div>
</section>

<section>
    <div class="section-shell">
        <div class="section-head">
            <h2 class="section-title">Dernieres <span>publications</span></h2>
            <p class="section-copy">Les documents et annonces officielles sont separes sur leur propre page, avec un apercu rapide depuis l accueil.</p>
        </div>
        <div class="card-grid">
            @forelse($latestPublications as $publication)
                <article class="pub-card">
                    <div class="pill">{{ ucfirst($publication->type) }}</div>
                    <div class="card-title" style="margin-top:1rem;">{{ $publication->title }}</div>
                    <p class="card-copy">{{ $publication->excerpt ?: 'Publication du Groupe Scout Saint Nicolas.' }}</p>
                    <div class="meta-row">
                        <span class="pill">{{ $publication->scoutUnit->name ?? 'Tous' }}</span>
                        <span class="pill">{{ optional($publication->publication_date)->format('d/m/Y') ?: 'Sans date' }}</span>
                    </div>
                </article>
            @empty
                <div class="empty-state">Aucune publication disponible pour le moment.</div>
            @endforelse
        </div>
        <div><a href="{{ route('site.publications') }}" class="btn"><i class="fa-solid fa-book-open"></i> Voir toutes les publications</a></div>
    </div>
</section>

<section>
    <div class="section-shell">
        <div class="section-head">
            <h2 class="section-title">Galerie des <span>unites</span></h2>
            <p class="section-copy">Les photos et videos publiees pour les unites apparaissent maintenant directement sur le site public.</p>
        </div>
        <div class="gallery-grid">
            @forelse($featuredGalleryItems as $item)
                @php($mediaPath = \Illuminate\Support\Str::startsWith($item->media_path, ['http://', 'https://']) ? $item->media_path : asset($item->media_path))
                <article class="gallery-card">
                    <div class="gallery-media">
                        @if($item->media_type === 'video')
                            <video controls preload="metadata">
                                <source src="{{ $mediaPath }}">
                            </video>
                        @else
                            <img src="{{ $mediaPath }}" alt="{{ $item->title }}">
                        @endif
                    </div>
                    <div class="gallery-body">
                        <div class="card-title">{{ $item->title }}</div>
                        <p class="card-copy">{{ $item->caption ?: 'Souvenir du Groupe Scout Saint Nicolas.' }}</p>
                        <div class="meta-row">
                            <span class="pill">{{ $item->scoutUnit->name ?? 'Groupe' }}</span>
                            @if($item->taken_at)
                                <span class="pill">{{ $item->taken_at->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">Aucun media public n est encore disponible.</div>
            @endforelse
        </div>
        <div><a href="{{ route('site.gallery') }}" class="btn"><i class="fa-solid fa-images"></i> Voir toute la galerie</a></div>
    </div>
</section>
@endsection

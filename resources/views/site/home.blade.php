@extends('site.layouts.app')

@section('title', 'Accueil - Groupe Scout Saint Nicolas')

@push('styles')
<style>
    .home-about {
        --about-navy: #1a2e6b;
        --about-gold: #f5c518;
        --about-surface: rgba(255, 255, 255, .94);
        --about-line: rgba(26, 46, 107, .10);
        --about-shadow: 0 26px 60px rgba(26, 46, 107, .12);
    }
    .home-about .section-shell {
        gap: 1.4rem;
    }
    .home-about-section {
        position: relative;
    }
    .home-about-shell {
        width: min(var(--max), calc(100% - 2rem));
        margin: 0 auto;
    }
    .home-about-head {
        text-align: center;
        display: grid;
        gap: .85rem;
        justify-items: center;
        margin-bottom: 1.3rem;
    }
    .home-about-head .section-title {
        color: var(--about-navy);
    }
    .home-about-head::after {
        content: '';
        width: 110px;
        height: 4px;
        border-radius: 999px;
        background: var(--about-navy);
    }
    .home-about-copy {
        max-width: 760px;
        color: var(--ink-500);
        line-height: 1.8;
    }
    .home-about-mission,
    .home-about-values-card,
    .home-about-objectives,
    .home-about-unit-card {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        background: var(--about-surface);
        border: 1px solid var(--about-line);
        box-shadow: var(--about-shadow);
    }
    .home-about-mission {
        padding: 2rem;
        background:
            radial-gradient(circle at top right, rgba(245, 197, 24, .16), transparent 18%),
            linear-gradient(180deg, rgba(255, 255, 255, .98), rgba(249, 251, 255, .96));
    }
    .home-about-mission-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(280px, .85fr);
        gap: 1.4rem;
        align-items: start;
    }
    .home-about-mission-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        color: var(--about-navy);
    }
    .home-about-mission-divider {
        width: min(220px, 48%);
        height: 6px;
        margin: 1rem 0 1.2rem;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--about-gold) 0%, var(--about-navy) 100%);
    }
    .home-about-mission-text {
        color: var(--ink-500);
        line-height: 1.85;
        font-size: 1rem;
    }
    .home-about-mission-aside {
        display: grid;
        gap: 1rem;
    }
    .home-about-note {
        padding: 1.15rem;
        border-radius: 22px;
        background: linear-gradient(180deg, #ffffff 0%, #f4f7ff 100%);
        border: 1px solid rgba(26, 46, 107, .08);
    }
    .home-about-note span {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        color: var(--about-navy);
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .07em;
        text-transform: uppercase;
    }
    .home-about-note strong {
        display: block;
        margin-top: .8rem;
        font-family: 'Space Grotesk', sans-serif;
        color: var(--about-navy);
        font-size: 1.12rem;
    }
    .home-about-note p {
        margin-top: .55rem;
        color: var(--ink-500);
        line-height: 1.7;
        font-size: .92rem;
    }
    .home-about-values {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }
    .home-about-values-card {
        padding: 1.5rem;
        text-align: center;
    }
    .home-about-values-icon {
        width: 74px;
        height: 74px;
        margin: 0 auto 1rem;
        border-radius: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--about-gold) 0%, var(--about-navy) 100%);
        color: #fff;
        font-size: 1.32rem;
        box-shadow: 0 18px 30px rgba(26, 46, 107, .18);
    }
    .home-about-values-card .card-title,
    .home-about-unit-card .card-title {
        color: var(--about-navy);
    }
    .home-about-values-card .card-copy {
        margin-top: .7rem;
    }
    .home-about-objectives {
        padding: 1.8rem;
    }
    .home-about-objectives-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .9rem 1.1rem;
    }
    .home-about-objective {
        display: flex;
        align-items: flex-start;
        gap: .8rem;
        padding: 1rem 1.05rem;
        border-radius: 20px;
        background: linear-gradient(180deg, #ffffff 0%, #f7f9ff 100%);
        border: 1px solid rgba(26, 46, 107, .08);
    }
    .home-about-check {
        flex-shrink: 0;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--about-navy);
        color: #fff;
        font-size: .85rem;
        box-shadow: 0 10px 18px rgba(26, 46, 107, .16);
    }
    .home-about-objective span:last-child {
        color: var(--ink-900);
        line-height: 1.65;
        font-weight: 700;
    }
    .home-about-units {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
    }
    .home-about-unit-card {
        display: grid;
        grid-template-rows: auto 1fr;
    }
    .home-about-unit-banner {
        padding: .92rem 1.2rem;
        background: var(--unit-banner);
        color: var(--unit-banner-text, #fff);
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: .02em;
    }
    .home-about-unit-body {
        padding: 1.3rem;
        display: grid;
        gap: .95rem;
    }
    .home-about-unit-topline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .8rem;
    }
    .home-about-unit-icon {
        width: 52px;
        height: 52px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(26, 46, 107, .08);
        color: var(--about-navy);
        font-size: 1.05rem;
    }
    .home-about-unit-age {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: .42rem .8rem;
        border-radius: 999px;
        background: rgba(26, 46, 107, .06);
        color: var(--about-navy);
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: .05em;
        text-transform: uppercase;
    }
    .home-about-unit-card .card-copy {
        margin-top: 0;
    }
    .home-about-unit-meta {
        display: grid;
        gap: .55rem;
    }
    .home-about-unit-meta span {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        color: var(--ink-500);
        font-size: .84rem;
        line-height: 1.55;
    }
    .home-about-unit-meta i {
        color: var(--about-navy);
    }
    @media (max-width: 980px) {
        .home-about-values {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .home-about-mission-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 780px) {
        .home-about-objectives-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 560px) {
        .home-about-mission,
        .home-about-values-card,
        .home-about-objectives,
        .home-about-unit-card {
            border-radius: 24px;
        }
        .home-about-values,
        .home-about-units {
            grid-template-columns: 1fr;
        }
        .home-about-mission,
        .home-about-objectives {
            padding: 1.25rem;
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
                <p class="card-copy" style="color:rgba(255,255,255,.72);margin-top:.6rem;text-align:center;">Le site n est plus une simple vitrine. L accueil presente maintenant directement notre mission, nos valeurs, nos objectifs et nos unites.</p>
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
<div class="home-about" id="a-propos">
    <section class="home-about-section">
        <div class="home-about-shell section-shell">
            <div class="home-about-head">
                <h2 class="section-title">Notre Mission</h2>
                <p class="home-about-copy">{{ $mission['subtitle'] ?? "L'essence de notre engagement aupres de la jeunesse." }}</p>
            </div>

            <article class="home-about-mission">
                <div class="home-about-mission-grid">
                    <div>
                        <h3 class="home-about-mission-title">Former des jeunes prêts a servir</h3>
                        <div class="home-about-mission-divider"></div>
                        <p class="home-about-mission-text">{{ $mission['text'] ?? "Le Groupe Scout Saint Nicolas contribue a l'education integrale des jeunes a travers la Promesse et la Loi scoutes, dans un cadre de service, d'aventure et de responsabilite." }}</p>
                    </div>

                    <aside class="home-about-mission-aside">
                        <div class="home-about-note">
                            <span><i class="fa-solid fa-star"></i> Notre engagement</span>
                            <strong>Eduquer par l'action</strong>
                            <p>Chaque activite aide les jeunes a grandir humainement, spirituellement et socialement.</p>
                        </div>
                        <div class="home-about-note">
                            <span><i class="fa-solid fa-handshake-angle"></i> Notre promesse</span>
                            <strong>Servir avec joie</strong>
                            <p>Nous formons des scouts capables d'aimer, de collaborer et de prendre leur place dans la communaute.</p>
                        </div>
                    </aside>
                </div>
            </article>
        </div>
    </section>

    <section class="home-about-section">
        <div class="home-about-shell section-shell">
            <div class="home-about-head">
                <h2 class="section-title">Nos Valeurs</h2>
                <p class="home-about-copy">Les piliers educatifs qui donnent du sens a la vie du groupe et a la progression de chaque scout.</p>
            </div>

            <div class="home-about-values">
                @foreach($aboutValues as $value)
                    <article class="home-about-values-card">
                        <div class="home-about-values-icon">
                            <i class="{{ $value['icon'] }}"></i>
                        </div>
                        <div class="card-title">{{ $value['title'] }}</div>
                        <p class="card-copy">{{ $value['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="home-about-section">
        <div class="home-about-shell section-shell">
            <div class="home-about-head">
                <h2 class="section-title">Nos Objectifs</h2>
                <p class="home-about-copy">{{ $objectives['subtitle'] ?? 'Ce que nous voulons construire au quotidien avec les jeunes et les familles.' }}</p>
            </div>

            <article class="home-about-objectives">
                <div class="home-about-objectives-grid">
                    @foreach($aboutObjectives as $objective)
                        <div class="home-about-objective">
                            <span class="home-about-check"><i class="fa-solid fa-check"></i></span>
                            <span>{{ $objective }}</span>
                        </div>
                    @endforeach
                </div>
            </article>
        </div>
    </section>

    <section class="home-about-section">
        <div class="home-about-shell section-shell">
            <div class="home-about-head">
                <h2 class="section-title">Nos Unites</h2>
                <p class="home-about-copy">Chaque branche possede son ambiance, son rythme de progression et sa maniere propre de faire vivre l'esprit scout.</p>
            </div>

            <div class="home-about-units">
                @foreach($aboutUnits as $unit)
                    <article class="home-about-unit-card" style="--unit-banner: {{ $unit['banner'] }}; --unit-banner-text: {{ $unit['banner_text'] ?? '#fff' }};">
                        <div class="home-about-unit-banner">{{ $unit['name'] }}</div>
                        <div class="home-about-unit-body">
                            <div class="home-about-unit-topline">
                                <div class="home-about-unit-icon">
                                    <i class="{{ $unit['icon'] }}"></i>
                                </div>
                                <div class="home-about-unit-age">{{ $unit['age_range'] }}</div>
                            </div>

                            <div class="card-title">{{ $unit['name'] }}</div>
                            <p class="card-copy">{{ $unit['description'] }}</p>

                            @if(!empty($unit['meta']))
                                <div class="home-about-unit-meta">
                                    @foreach($unit['meta'] as $meta)
                                        <span><i class="fa-solid fa-circle-dot"></i> {{ $meta }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

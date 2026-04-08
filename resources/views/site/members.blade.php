@extends('site.layouts.app')

@section('title', 'Membres - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Communautes et inscriptions')
@section('page_title', 'La vie des <span>membres</span>')
@section('page_summary', 'Cette page se concentre sur les inscriptions et les statistiques du groupe, au lieu de melanger ces informations avec le reste du site.')

@section('content')
<section>
    <div class="section-shell">
        <div class="stats-grid">
            <div class="stat-chip"><strong>{{ $memberStats['active'] }}</strong><span>Actifs</span></div>
            <div class="stat-chip"><strong>{{ $memberStats['pending'] }}</strong><span>En attente</span></div>
            <div class="stat-chip"><strong>{{ $memberStats['inactive'] }}</strong><span>Inactifs</span></div>
            <div class="stat-chip"><strong>{{ $memberStats['total'] }}</strong><span>Total</span></div>
        </div>
    </div>
</section>

<section>
    <div class="section-shell">
        <div class="tab-navigation">
            <a href="#recent" class="tab-link active">Dernières inscriptions</a>
            <a href="#maitrise" class="tab-link">Maitrise</a>
            <a href="#units" class="tab-link">Par unité</a>
        </div>
    </div>
</section>

<section id="recent">
    <div class="section-shell callout-grid">
        <article class="callout-card">
            <div class="section-head">
                <h2 class="section-title">Dernieres <span>inscriptions</span></h2>
                <p class="section-copy">Les inscriptions publiques sont stockees en base et retrouvent leur place dans une page dediee au suivi des membres.</p>
            </div>
            <div class="member-list">
                @forelse($recentMembers as $member)
                    <div class="member-row">
                        <div class="member-avatar">{{ strtoupper(substr($member->first_name, 0, 1).substr($member->last_name, 0, 1)) }}</div>
                        <div class="member-info">
                            <div class="member-name">{{ $member->full_name }}</div>
                            <div class="member-details">{{ $member->scoutUnit->name ?? 'Sans unite' }} - {{ $member->age }} ans</div>
                        </div>
                        <div class="member-meta">
                            <span class="pill">{{ ucfirst($member->status) }}</span>
                            @if($member->member_function)
                                <span class="pill">{{ $member->member_function }}</span>
                            @endif
                            @if($member->registered_at)
                                <span class="pill">{{ $member->registered_at->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">Aucun membre recent a afficher.</div>
                @endforelse
            </div>
        </article>
    </div>
</section>

<section id="maitrise">
    <div class="section-shell callout-grid">
        <article class="callout-card">
            <div class="section-head">
                <h2 class="section-title">Equipe de <span>maitrise</span></h2>
                <p class="section-copy">L'equipe encadrante et les responsables qui font vivre le groupe scout.</p>
            </div>
            <div class="member-grid">
                @forelse($maitriseMembers as $member)
                    <article class="member-card">
                        <div class="member-avatar">{{ strtoupper(substr($member->first_name, 0, 1).substr($member->last_name, 0, 1)) }}</div>
                        <div class="card-title">{{ $member->full_name }}</div>
                        <p class="card-copy">{{ $member->member_function }}</p>
                        <div class="meta-row">
                            <span class="pill">{{ $member->scoutUnit->name ?? 'Groupe' }}</span>
                            @if($member->registered_at)
                                <span class="pill">{{ $member->registered_at->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="empty-state">Aucun membre de la maitrise a afficher.</div>
                @endforelse
            </div>
        </article>
    </div>
</section>

<section id="units">
    <div class="section-shell callout-grid">
        <article class="callout-card">
            <div class="section-head">
                <h2 class="section-title">Repartition par <span>unite</span></h2>
            </div>
            <div class="unit-list">
                @forelse($membersByUnit as $unit)
                    <div class="unit-row">
                        <div class="unit-icon">
                            <div class="card-icon" style="width:40px;height:40px;border-radius:12px;font-size:1rem;margin:0;background:{{ $unit->accent_color ?: 'rgba(33, 75, 143, .12)' }};color:{{ $unit->color ?: '#214b8f' }};">
                                <i class="{{ $unit->icon ?: 'fa-solid fa-tent' }}"></i>
                            </div>
                        </div>
                        <div class="unit-info">
                            <div class="unit-name">{{ $unit->name }}</div>
                            <div class="unit-stats">{{ $unit->active_members_count }} actifs, {{ $unit->pending_members_count }} en attente, {{ $unit->members_count }} total</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">Aucune statistique disponible.</div>
                @endforelse
            </div>
        </article>
    </div>
</section>
@endsection

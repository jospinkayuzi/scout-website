@extends('site.layouts.app')

@section('title', 'Programme - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Agenda des unites')
@section('page_title', 'Le programme du groupe')
@section('page_summary', 'Le programme est desormais maintenu comme un contenu dynamique dans la base de donnees et organise par unite sur une page distincte.')

@section('content')
<section>
    <div class="section-shell">
        <div class="program-grid">
            @forelse($units as $unit)
                <article class="program-card">
                    <div class="card-icon" style="background:{{ $unit->accent_color ?: 'rgba(33, 75, 143, .12)' }};color:{{ $unit->color ?: '#214b8f' }};">
                        <i class="{{ $unit->icon ?: 'fa-solid fa-calendar-days' }}"></i>
                    </div>
                    <div class="card-title">{{ $unit->name }}</div>
                    <p class="card-copy">{{ $unit->schedule ?: 'Horaire a confirmer' }}</p>
                    <div class="timeline">
                        @forelse($unit->programEvents as $event)
                            <div class="timeline-item">
                                <div class="timeline-date"><i class="fa-solid fa-calendar-days"></i> {{ $event->event_date->format('d/m/Y') }} @if($event->time_label) - {{ $event->time_label }} @endif</div>
                                <div class="card-title" style="font-size:1rem;margin-top:.45rem;">{{ $event->title }}</div>
                                @if($event->description)
                                    <p class="meta-copy">{{ $event->description }}</p>
                                @endif
                                <div class="meta-row">
                                    @if($event->responsible)
                                        <span class="pill">{{ $event->responsible }}</span>
                                    @endif
                                    @if($event->location)
                                        <span class="pill">{{ $event->location }}</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">Aucune activite planifiee pour cette unite.</div>
                        @endforelse
                    </div>
                </article>
            @empty
                <div class="empty-state">Le programme n est pas encore disponible.</div>
            @endforelse
        </div>
    </div>
</section>

<section>
    <div class="section-shell">
        <div class="section-head">
            <h2 class="section-title">Nos prochains<span> rendez-vous</span></h2>
            <p class="section-copy">Cette section met en avant les rendez-vous communs du groupe qui rassemblent toutes les unites.</p>
        </div>
        <div class="card-grid">
            @forelse($groupUpcomingEvents as $event)
                <article class="info-card">
                    <div class="card-icon"><i class="fa-solid fa-bullhorn"></i></div>
                    <div class="card-title">{{ $event->title }}</div>
                    <p class="card-copy">{{ $event->scoutUnit->name ?? 'Toutes les unites' }}</p>
                    <div class="meta-row">
                        <span class="pill">{{ $event->event_date->format('d/m/Y') }}</span>
                        @if($event->time_label)
                            <span class="pill">{{ $event->time_label }}</span>
                        @endif
                        @if($event->location)
                            <span class="pill">{{ $event->location }}</span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-state">Aucun rendez-vous du groupe n est encore programme pour toutes les unites.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection

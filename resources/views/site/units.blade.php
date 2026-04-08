@extends('site.layouts.app')

@section('title', 'Unites - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Branches et progression')
@section('page_title', 'Des unites pour chaque etape')
@section('page_summary', 'Chaque unite dispose de sa propre identite, de responsables, d un rythme et d activites dediees. Les contenus restent maintenant separes dans une page specifique.')

@section('content')
<section>
    <div class="section-shell">
        <div class="card-grid">
            @forelse($units as $unit)
                <article class="unit-card">
                    <div class="card-icon" style="background:{{ $unit->accent_color ?: 'rgba(33, 75, 143, .12)' }};color:{{ $unit->color ?: '#214b8f' }};">
                        <i class="{{ $unit->icon ?: 'fa-solid fa-tent' }}"></i>
                    </div>
                    <div class="card-title">{{ $unit->name }}</div>
                    <p class="card-copy">{{ $unit->short_description }}</p>
                    @if($unit->long_description)
                        <p class="meta-copy">{{ $unit->long_description }}</p>
                    @endif
                    <div class="pill-row">
                        <span class="pill">{{ $unit->age_range }}</span>
                        @if($unit->gender_scope)
                            <span class="pill">{{ $unit->gender_scope }}</span>
                        @endif
                        @if($unit->leader_name)
                            <span class="pill">{{ $unit->leader_name }}</span>
                        @endif
                        @if($unit->schedule)
                            <span class="pill">{{ $unit->schedule }}</span>
                        @endif
                        <span class="pill">{{ $unit->active_members_count ?? 0 }} actifs</span>
                    </div>
                </article>
            @empty
                <div class="empty-state">Aucune unite n est encore disponible.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@extends('site.layouts.app')

@section('title', 'Publications - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Documents et actualites')
@section('page_title', 'Publications et documents')
@section('page_summary', 'Les reglements, statuts, annonces et articles ne partagent plus la page d accueil. Ils ont maintenant leur propre espace de consultation.')

@section('content')
<section>
    <div class="section-shell">
        <div class="stats-grid">
            <div class="stat-chip"><strong>{{ $publicationSummary['total'] }}</strong><span>Total</span></div>
            <div class="stat-chip"><strong>{{ $publicationSummary['statuts'] }}</strong><span>Statuts</span></div>
            <div class="stat-chip"><strong>{{ $publicationSummary['reglements'] }}</strong><span>Reglements</span></div>
            <div class="stat-chip"><strong>{{ $publicationSummary['articles'] + $publicationSummary['annonces'] }}</strong><span>Articles & annonces</span></div>
        </div>
    </div>
</section>

<section>
    <div class="section-shell">
        <div class="card-grid">
            @forelse($publications as $publication)
                <article class="pub-card">
                    <div class="pill">{{ ucfirst($publication->type) }}</div>
                    <div class="card-title" style="margin-top:1rem;">{{ $publication->title }}</div>
                    <p class="card-copy">{{ $publication->excerpt ?: 'Document publie pour la vie du groupe scout.' }}</p>
                    @if($publication->body)
                        <p class="meta-copy">{{ \Illuminate\Support\Str::limit($publication->body, 180) }}</p>
                    @endif
                    <div class="meta-row">
                        <span class="pill">{{ $publication->scoutUnit->name ?? 'Tous' }}</span>
                        <span class="pill">{{ $publication->author ?? 'GSN' }}</span>
                        <span class="pill">{{ optional($publication->publication_date)->format('d/m/Y') ?: 'Sans date' }}</span>
                    </div>
                </article>
            @empty
                <div class="empty-state">Aucune publication disponible.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection

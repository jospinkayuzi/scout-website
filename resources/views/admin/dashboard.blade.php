@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('breadcrumb', 'Tableau de bord')

@section('content')
<div class="stat-grid">
    @foreach($overviewCards as $card)
        <div class="stat-card">
            <div class="stat-icon {{ $card['theme'] }}"><i class="{{ $card['icon'] }}"></i></div>
            <div>
                <div class="stat-value">{{ $card['value'] }}</div>
                <div class="stat-label">{{ $card['label'] }}</div>
            </div>
        </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-layer-group"></i> Modules de contenu</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Tous les contenus dynamiques sont maintenant gerables depuis l administration.</p>
        </div>
    </div>
    <div class="card-body padded">
        <div class="module-grid">
            @forelse($contentModules as $module)
                <article class="module-card">
                    <div class="module-top">
                        <div class="stat-icon {{ $module['theme'] }}"><i class="{{ $module['icon'] }}"></i></div>
                        <span class="badge badge-{{ $module['theme'] }}">{{ $module['count'] }} elements</span>
                    </div>
                    <div>
                        <div class="module-title">{{ $module['label'] }}</div>
                        <p class="module-copy">{{ $module['description'] }}</p>
                    </div>
                    <div class="module-footer">
                        <a href="{{ $module['route'] }}" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-arrow-right"></i> Ouvrir
                        </a>
                    </div>
                </article>
            @empty
                <div class="empty-state" style="grid-column:1/-1;">
                    <i class="fa-solid fa-lock"></i>
                    <p>Aucun module supplementaire n est disponible pour ce profil.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1.25rem;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-clock-rotate-left"></i> Derniers utilisateurs</h2>
            @if(auth()->user()->hasPermission('gerer_utilisateurs') || auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-plus"></i> Nouvel utilisateur
                </a>
            @endif
        </div>
        <div class="card-body padded">
            <div class="stack-list">
                @forelse($recentUsers as $user)
                    <div class="stack-item">
                        <div>
                            <div class="stack-title">{{ $user->name }}</div>
                            <div class="stack-subtitle">{{ $user->email }}</div>
                        </div>
                        <div style="text-align:right;">
                            <div class="badge badge-gray">{{ $user->role->name ?? 'Aucun role' }}</div>
                            <div class="stack-subtitle">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-users-slash"></i>
                        <p>Aucun utilisateur</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-id-card"></i> Inscriptions recentes</h2>
            <span class="badge badge-blue">{{ $recentMembers->count() }} recentes</span>
        </div>
        <div class="card-body padded">
            <div class="stack-list">
                @forelse($recentMembers as $member)
                    <div class="stack-item">
                        <div>
                            <div class="stack-title">{{ $member->full_name }}</div>
                            <div class="stack-subtitle">{{ $member->scoutUnit->name ?? 'Sans unite' }}</div>
                        </div>
                        <div style="text-align:right;">
                            <span class="badge {{ $member->status === 'active' ? 'badge-green' : ($member->status === 'pending' ? 'badge-amber' : 'badge-gray') }}">
                                {{ ucfirst($member->status) }}
                            </span>
                            <div class="stack-subtitle">{{ optional($member->registered_at)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-id-card-clip"></i>
                        <p>Aucune inscription recente</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-newspaper"></i> Publications recentes</h2>
            <span class="badge badge-purple">{{ $recentPublications->count() }} elements</span>
        </div>
        <div class="card-body padded">
            <div class="stack-list">
                @forelse($recentPublications as $publication)
                    <div class="stack-item">
                        <div>
                            <div class="stack-title">{{ $publication->title }}</div>
                            <div class="stack-subtitle">{{ $publication->scoutUnit->name ?? 'Tous' }} - {{ $publication->author ?? 'GSN' }}</div>
                        </div>
                        <div style="text-align:right;">
                            <span class="badge badge-blue">{{ ucfirst($publication->type) }}</span>
                            <div class="stack-subtitle">{{ optional($publication->publication_date)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-folder-open"></i>
                        <p>Aucune publication</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-calendar-days"></i> Evenements a venir</h2>
            <span class="badge badge-amber">{{ $upcomingEvents->count() }} a suivre</span>
        </div>
        <div class="card-body padded">
            <div class="stack-list">
                @forelse($upcomingEvents as $event)
                    <div class="stack-item">
                        <div>
                            <div class="stack-title">{{ $event->title }}</div>
                            <div class="stack-subtitle">{{ $event->scoutUnit->name ?? 'Toutes les unites' }} @if($event->location) - {{ $event->location }} @endif</div>
                        </div>
                        <div style="text-align:right;">
                            <div class="badge badge-amber">{{ $event->event_date->format('d/m/Y') }}</div>
                            <div class="stack-subtitle">{{ $event->time_label ?? 'Horaire a definir' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa-solid fa-calendar-xmark"></i>
                        <p>Aucun evenement programme.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

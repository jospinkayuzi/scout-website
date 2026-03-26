@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('breadcrumb', 'Tableau de bord')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon green"><i class="fa-solid fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $stats['users'] }}</div>
            <div class="stat-label">Utilisateurs</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber"><i class="fa-solid fa-shield-halved"></i></div>
        <div>
            <div class="stat-value">{{ $stats['roles'] }}</div>
            <div class="stat-label">Rôles</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fa-solid fa-key"></i></div>
        <div>
            <div class="stat-value">{{ $stats['permissions'] }}</div>
            <div class="stat-label">Permissions</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-clock-rotate-left"></i> Derniers utilisateurs</h2>
        @if(auth()->user()->hasPermission('gerer_utilisateurs') || auth()->user()->isSuperAdmin())
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i> Nouvel utilisateur
        </a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Rôle</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUsers as $user)
                    <tr>
                        <td style="font-weight:600;">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role)
                                @php
                                    $colors = ['Super Admin' => 'green', 'Administrateur' => 'amber', 'Éditeur' => 'blue', 'Membre' => 'gray'];
                                    $c = $colors[$user->role->name] ?? 'gray';
                                @endphp
                                <span class="badge badge-{{ $c }}">{{ $user->role->name }}</span>
                            @else
                                <span class="badge badge-gray">Aucun</span>
                            @endif
                        </td>
                        <td style="color:var(--gray-500);font-size:.8rem;">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="fa-solid fa-users-slash"></i>
                                <p>Aucun utilisateur</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

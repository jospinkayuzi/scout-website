@extends('admin.layouts.app')

@section('title', 'Utilisateurs')
@section('breadcrumb', 'Utilisateurs')

@section('content')
<div class="card">
    <div class="card-header">
        <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;">
            <h2><i class="fa-solid fa-users"></i> Liste des utilisateurs</h2>
            <span class="badge badge-gray">{{ $users->total() }} au total</span>
        </div>
        <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;">
            <form method="GET" action="{{ route('admin.users.index') }}" style="display:flex;gap:.5rem;align-items:center;">
                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher...">
                </div>
                <select name="role" class="form-select" onchange="this.form.submit()" style="padding:.45rem .6rem;font-size:.82rem;">
                    <option value="">Tous les rôles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus"></i> Nouveau
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Rôle</th>
                        <th>Créé le</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem;">
                                <div style="width:32px;height:32px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:.75rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span style="font-weight:600;">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role)
                                @php
                                    $colors = ['Super Admin' => 'green', 'Administrateur' => 'amber', 'Éditeur' => 'blue', 'Membre' => 'gray'];
                                    $c = $colors[$user->role->name] ?? 'purple';
                                @endphp
                                <span class="badge badge-{{ $c }}">{{ $user->role->name }}</span>
                            @else
                                <span class="badge badge-gray">Aucun</span>
                            @endif
                        </td>
                        <td style="color:var(--gray-500);font-size:.8rem;">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="actions" style="justify-content:flex-end;">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm" title="Modifier">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fa-solid fa-users-slash"></i>
                                <p>Aucun utilisateur trouvé</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($users->hasPages())
<div class="pagination">
    {{ $users->withQueryString()->links() }}
</div>
@endif
@endsection

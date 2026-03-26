@extends('admin.layouts.app')

@section('title', 'Rôles & Permissions')
@section('breadcrumb', 'Rôles & Permissions')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-shield-halved"></i> Gestion des rôles</h2>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-plus"></i> Nouveau rôle
        </a>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Rôle</th>
                        <th>Description</th>
                        <th>Permissions</th>
                        <th>Utilisateurs</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                    <tr>
                        <td>
                            @php
                                $colors = ['Super Admin' => 'green', 'Administrateur' => 'amber', 'Éditeur' => 'blue', 'Membre' => 'gray'];
                                $c = $colors[$role->name] ?? 'purple';
                            @endphp
                            <span class="badge badge-{{ $c }}" style="font-size:.85rem;">{{ $role->name }}</span>
                        </td>
                        <td style="color:var(--gray-500);font-size:.85rem;">{{ $role->description }}</td>
                        <td><span class="badge badge-blue">{{ $role->permissions_count }} permissions</span></td>
                        <td><span class="badge badge-gray">{{ $role->users_count }} utilisateurs</span></td>
                        <td>
                            <div class="actions" style="justify-content:flex-end;">
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-secondary btn-sm" title="Modifier">
                                    <i class="fa-solid fa-pen-to-square"></i> Modifier
                                </a>
                                @if($role->users_count === 0)
                                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" onsubmit="return confirm('Supprimer ce rôle ?');" style="margin:0;">
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
                                <i class="fa-solid fa-shield-halved"></i>
                                <p>Aucun rôle défini</p>
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

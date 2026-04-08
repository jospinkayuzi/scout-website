@extends('admin.layouts.app')

@section('title', 'Unites')
@section('breadcrumb', 'Unites')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-tents"></i> Unites du groupe</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Structure, identite visuelle et ordre d affichage du site.</p>
        </div>
        <a href="{{ route('admin.scout-units.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Nouvelle unite</a>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Unite</th>
                        <th>Age</th>
                        <th>Leader</th>
                        <th>Membres</th>
                        <th>Contenus</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($units as $unit)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:.75rem;">
                                    <div class="stat-icon blue" style="background:{{ $unit->accent_color ?: '#e9eef9' }};color:{{ $unit->color ?: '#19356d' }};"><i class="{{ $unit->icon ?: 'fa-solid fa-tent' }}"></i></div>
                                    <div>
                                        <div style="font-weight:700;">{{ $unit->name }}</div>
                                        <div style="color:var(--gray-500);font-size:.8rem;">/{{ $unit->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $unit->age_range }}</td>
                            <td>{{ $unit->leader_name ?: 'A definir' }}</td>
                            <td><span class="badge badge-green">{{ $unit->members_count }} membres</span></td>
                            <td>
                                <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
                                    <span class="badge badge-blue">{{ $unit->publications_count }} publications</span>
                                    <span class="badge badge-purple">{{ $unit->gallery_items_count }} medias galerie</span>
                                    <span class="badge badge-amber">{{ $unit->program_events_count }} evenements</span>
                                    <span class="badge {{ $unit->is_active ? 'badge-green' : 'badge-gray' }}">{{ $unit->is_active ? 'Active' : 'Masquee' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.gallery-items.index', ['scout_unit_id' => $unit->id]) }}" class="btn btn-secondary btn-sm" title="Voir la galerie">
                                        <i class="fa-solid fa-images"></i>
                                    </a>
                                    <a href="{{ route('admin.gallery-items.create', ['scout_unit_id' => $unit->id]) }}" class="btn btn-success btn-sm" title="Ajouter un media">
                                        <i class="fa-solid fa-camera"></i>
                                    </a>
                                    <a href="{{ route('admin.scout-units.edit', $unit) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{ route('admin.scout-units.destroy', $unit) }}" onsubmit="return confirm('Supprimer cette unite ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"><div class="empty-state"><i class="fa-solid fa-tent"></i><p>Aucune unite enregistree.</p></div></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($units->hasPages())
    <div class="pagination">{{ $units->links() }}</div>
@endif
@endsection

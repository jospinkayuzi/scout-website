@extends('admin.layouts.app')

@section('title', 'Galerie')
@section('breadcrumb', 'Galerie')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-images"></i> Galerie media</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Photos et videos visibles sur le site public.</p>
        </div>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;">
            <form method="GET" action="{{ route('admin.gallery-items.index') }}" style="display:flex;gap:.55rem;align-items:center;flex-wrap:wrap;">
                <select name="scout_unit_id" class="form-select" style="min-width:220px;">
                    <option value="">Toutes les galeries</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" @selected((string) $selectedUnitId === (string) $unit->id)>{{ $unit->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-filter"></i> Filtrer</button>
                @if($selectedUnitId)
                    <a href="{{ route('admin.gallery-items.index') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-rotate-left"></i> Reinitialiser</a>
                @endif
            </form>
            <a href="{{ route('admin.gallery-items.create', array_filter(['scout_unit_id' => $selectedUnitId])) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Nouveau media</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Media</th>
                        <th>Type</th>
                        <th>Unite</th>
                        <th>Date</th>
                        <th>Etat</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleryItems as $galleryItem)
                        <tr>
                            <td>
                                <div style="font-weight:700;">{{ $galleryItem->title }}</div>
                                <div style="color:var(--gray-500);font-size:.8rem;">{{ $galleryItem->event_name ?: 'Sans evenement' }}</div>
                            </td>
                            <td><span class="badge badge-blue">{{ ucfirst($galleryItem->media_type) }}</span></td>
                            <td>{{ $galleryItem->scoutUnit->name ?? 'Tous' }}</td>
                            <td>{{ optional($galleryItem->taken_at)->format('d/m/Y') ?: 'Sans date' }}</td>
                            <td><span class="badge {{ $galleryItem->is_featured ? 'badge-green' : 'badge-gray' }}">{{ $galleryItem->is_featured ? 'Mis en avant' : 'Standard' }}</span></td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.gallery-items.edit', $galleryItem) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{ route('admin.gallery-items.destroy', $galleryItem) }}" onsubmit="return confirm('Supprimer ce media ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-images"></i><p>{{ $selectedUnitId ? 'Aucun media enregistre pour cette unite.' : 'Aucun media enregistre.' }}</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($galleryItems->hasPages())
    <div class="pagination">{{ $galleryItems->links() }}</div>
@endif
@endsection

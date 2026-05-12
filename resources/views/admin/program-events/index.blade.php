@extends('admin.layouts.app')

@section('title', 'Programme')
@section('breadcrumb', 'Programme')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-calendar-days"></i> Evenements et agenda</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Planning dynamique des unites.</p>
        </div>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;">
            <form method="GET" action="{{ route('admin.program-events.index') }}" style="display:flex;gap:.55rem;align-items:center;flex-wrap:wrap;">
                <select name="scout_unit_id" class="form-select" style="min-width:220px;">
                    <option value="">Toutes les unites</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" @selected((string) $selectedUnitId === (string) $unit->id)>{{ $unit->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-secondary btn-sm"><i class="fa-solid fa-filter"></i> Filtrer</button>
                @if($selectedUnitId)
                    <a href="{{ route('admin.program-events.index') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-rotate-left"></i> Reinitialiser</a>
                @endif
            </form>
            <a href="{{ route('admin.program-events.create', array_filter(['scout_unit_id' => $selectedUnitId])) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Nouvel evenement</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Evenement</th>
                        <th>Unite</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Etat</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programEvents as $programEvent)
                        <tr>
                            <td>
                                <div style="font-weight:700;">{{ $programEvent->title }}</div>
                                <div style="color:var(--gray-500);font-size:.8rem;">{{ $programEvent->responsible ?: 'Sans responsable' }}</div>
                            </td>
                            <td>{{ $programEvent->scoutUnit->name ?? 'Toutes les unites' }}</td>
                            <td>{{ $programEvent->event_date->format('d/m/Y') }} @if($programEvent->time_label)<div style="color:var(--gray-500);font-size:.8rem;">{{ $programEvent->time_label }}</div>@endif</td>
                            <td>{{ $programEvent->location ?: 'A definir' }}</td>
                            <td><span class="badge {{ $programEvent->is_public ? 'badge-green' : 'badge-gray' }}">{{ $programEvent->is_public ? 'Public' : 'Prive' }}</span></td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.program-events.edit', $programEvent) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{ route('admin.program-events.destroy', $programEvent) }}" onsubmit="return confirm('Supprimer cet evenement ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-calendar-xmark"></i><p>Aucun evenement programme.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($programEvents->hasPages())
    <div class="pagination">{{ $programEvents->links() }}</div>
@endif
@endsection

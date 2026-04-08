@extends('admin.layouts.app')

@section('title', 'Publications')
@section('breadcrumb', 'Publications')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-newspaper"></i> Publications et documents</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Reglements, statuts, annonces et articles du groupe.</p>
        </div>
        <a href="{{ route('admin.publications.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Nouvelle publication</a>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Type</th>
                        <th>Unite</th>
                        <th>Date</th>
                        <th>Etat</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publications as $publication)
                        <tr>
                            <td>
                                <div style="font-weight:700;">{{ $publication->title }}</div>
                                <div style="color:var(--gray-500);font-size:.8rem;">{{ $publication->author ?: 'GSN' }}</div>
                            </td>
                            <td><span class="badge badge-blue">{{ ucfirst($publication->type) }}</span></td>
                            <td>{{ $publication->scoutUnit->name ?? 'Tous' }}</td>
                            <td>{{ optional($publication->publication_date)->format('d/m/Y') ?: 'Sans date' }}</td>
                            <td><span class="badge {{ $publication->is_published ? 'badge-green' : 'badge-gray' }}">{{ $publication->is_published ? 'Publiee' : 'Brouillon' }}</span></td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.publications.edit', $publication) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{ route('admin.publications.destroy', $publication) }}" onsubmit="return confirm('Supprimer cette publication ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-newspaper"></i><p>Aucune publication disponible.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($publications->hasPages())
    <div class="pagination">{{ $publications->links() }}</div>
@endif
@endsection

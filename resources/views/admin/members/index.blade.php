@extends('admin.layouts.app')

@section('title', 'Membres')
@section('breadcrumb', 'Membres')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-id-card"></i> Membres et inscriptions</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Suivi complet des demandes et des statuts.</p>
        </div>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;">
            <form method="GET" action="{{ route('admin.members.index') }}">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Tous les statuts</option>
                    <option value="active" @selected(request('status') === 'active')>Actifs</option>
                    <option value="pending" @selected(request('status') === 'pending')>En attente</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactifs</option>
                </select>
            </form>
            <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Nouveau membre</a>
        </div>
    </div>
    <div class="card-body">
        <div style="margin-bottom:1rem;">
            <div style="display:flex;gap:.5rem;border-bottom:1px solid var(--gray-200);">
                <a href="{{ route('admin.members.index', array_merge(request()->query(), ['type' => null])) }}" class="tab-link {{ !request('type') ? 'active' : '' }}">Tous les membres</a>
                <a href="{{ route('admin.members.index', array_merge(request()->query(), ['type' => 'maitrise'])) }}" class="tab-link {{ request('type') === 'maitrise' ? 'active' : '' }}">Maitrise</a>
            </div>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Membre</th>
                        <th>Unite</th>
                        <th>Contact</th>
                        <th>Statut</th>
                        <th>Inscription</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>
                                <div style="font-weight:700;">{{ $member->full_name }}</div>
                                <div style="color:var(--gray-500);font-size:.8rem;">{{ $member->member_function ?: 'Membre' }}</div>
                            </td>
                            <td>{{ $member->scoutUnit->name ?? 'Sans unite' }}</td>
                            <td>
                                <div>{{ $member->email ?: 'Sans email' }}</div>
                                <div style="color:var(--gray-500);font-size:.8rem;">{{ $member->phone ?: 'Sans telephone' }}</div>
                            </td>
                            <td><span class="badge {{ $member->status === 'active' ? 'badge-green' : ($member->status === 'pending' ? 'badge-amber' : 'badge-gray') }}">{{ ucfirst($member->status) }}</span></td>
                            <td>{{ optional($member->registered_at)->format('d/m/Y') ?: 'Sans date' }}</td>
                            <td>
                                <div class="actions">
                                    @if($member->status === 'pending')
                                        <form method="POST" action="{{ route('admin.members.approve', $member) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" title="Approuver"><i class="fa-solid fa-check"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.members.reject', $member) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" title="Rejeter" onclick="return confirm('Rejeter ce membre ?');"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    @elseif($member->status === 'inactive')
                                        <form method="POST" action="{{ route('admin.members.reactivate', $member) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" title="Reactiver"><i class="fa-solid fa-rotate-right"></i></button>
                                        </form>
                                    @endif
                                    @if(auth()->user()->hasRole('Super Admin') && $member->status === 'active')
                                        @php
                                            $maitriseFunctions = ['Cheffe de Groupe', 'Assistant chef de groupe', 'Secrétaire', 'Trésorier(e)', 'Akela (Chef d\'unité Meute)', 'Baghera (Assistants)', 'Baloo', 'Troupe F', 'Troupe M', 'Grappe', 'Amical', 'Disciplinaire', 'Chargé du matériel', 'Chargée du social', 'Chargé de la communication', 'Animation du groupe', 'Chargé de la spiritualité', 'Chargé des projets, partenariats et développement du groupe', 'Chargé des événements et de l\'expression des talents'];
                                        @endphp
                                        @if(!in_array($member->member_function, $maitriseFunctions))
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#maitriseFunctionModal" onclick="setMemberData({{ $member->id }}, '{{ $member->full_name }}');" title="Ajouter à la maîtrise"><i class="fa-solid fa-star"></i></button>
                                        @endif
                                    @endif
                                    <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-id-card"></i><p>Aucun membre enregistre.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($members->hasPages())
    <div class="pagination">{{ $members->links() }}</div>
@endif

@if(auth()->user()->hasRole('Super Admin'))
<!-- Modal pour promouvoir à la maîtrise -->
<div class="modal fade" id="maitriseFunctionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter à la maîtrise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="maitriseFunctionForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Membre</label>
                        <input type="text" id="memberName" class="form-input" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fonction de maîtrise *</label>
                        <select name="member_function" class="form-select" required>
                            <option value="">Choisir une fonction</option>
                            <optgroup label="Direction">
                                <option value="Cheffe de Groupe">Cheffe de Groupe</option>
                                <option value="Assistant chef de groupe">Assistant chef de groupe</option>
                                <option value="Secrétaire">Secrétaire</option>
                                <option value="Trésorier(e)">Trésorier(e)</option>
                            </optgroup>
                            <optgroup label="Chefs d'unité">
                                <option value="Akela (Chef d'unité Meute)">Akela (Chef d'unité Meute)</option>
                                <option value="Baghera (Assistants)">Baghera (Assistants)</option>
                                <option value="Baloo">Baloo</option>
                                <option value="Troupe F">Troupe F</option>
                                <option value="Troupe M">Troupe M</option>
                                <option value="Grappe">Grappe</option>
                                <option value="Amical">Amical</option>
                            </optgroup>
                            <optgroup label="Fonctions">
                                <option value="Disciplinaire">Disciplinaire</option>
                                <option value="Chargé du matériel">Chargé du matériel</option>
                                <option value="Chargée du social">Chargée du social</option>
                                <option value="Chargé de la communication">Chargé de la communication</option>
                                <option value="Animation du groupe">Animation du groupe</option>
                                <option value="Chargé de la spiritualité">Chargé de la spiritualité</option>
                                <option value="Chargé des projets, partenariats et développement du groupe">Chargé des projets, partenariats et développement du groupe</option>
                                <option value="Chargé des événements et de l'expression des talents">Chargé des événements et de l'expression des talents</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Promouvoir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setMemberData(memberId, memberName) {
    document.getElementById('memberName').value = memberName;
    const form = document.getElementById('maitriseFunctionForm');
    form.action = '/admin/members/' + memberId + '/promote-to-maitrise';
}
</script>
@endif
@endsection

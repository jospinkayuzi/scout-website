@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('breadcrumb', 'Tableau de bord')

@section('content')
@if(!empty($overviewCards))
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
@endif

@if($reviewAccess['can_review'])
    <div class="card">
        <div class="card-header">
            <div>
                <h2><i class="fa-solid fa-user-clock"></i> Inscriptions a valider</h2>
                <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">
                    {{ $reviewAccess['can_manage_all_units'] ? 'Validez les nouvelles demandes du groupe depuis le dashboard.' : 'Validez uniquement les demandes de votre unite depuis le dashboard.' }}
                </p>
            </div>
            <span class="badge badge-amber">{{ $pendingRegistrations->count() }} affichees</span>
        </div>
        <div class="card-body">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Membre</th>
                            <th>Unite</th>
                            <th>Contact</th>
                            <th>Date</th>
                            <th style="text-align:right;">Validation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingRegistrations as $member)
                            <tr>
                                <td>
                                    <div style="font-weight:700;">{{ $member->full_name }}</div>
                                    <div style="color:var(--gray-500);font-size:.8rem;">{{ $member->age ? $member->age . ' ans' : 'Age non renseigne' }}</div>
                                </td>
                                <td>{{ $member->scoutUnit->name ?? 'Sans unite' }}</td>
                                <td>
                                    <div>{{ $member->phone ?: 'Sans telephone' }}</div>
                                    <div style="color:var(--gray-500);font-size:.8rem;">{{ $member->guardian_phone ?: ($member->parent_name ?: 'Sans contact tuteur') }}</div>
                                </td>
                                <td>{{ optional($member->registered_at)->format('d/m/Y') ?: 'Sans date' }}</td>
                                <td>
                                    <div class="actions">
                                        <form method="POST" action="{{ route('admin.members.approve', $member) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" title="Approuver"><i class="fa-solid fa-check"></i> Approuver</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.members.reject', $member) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" title="Rejeter" onclick="return confirm('Rejeter cette inscription ?');"><i class="fa-solid fa-xmark"></i> Rejeter</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-check-double"></i>
                                        <p>Aucune inscription en attente pour le moment.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@if(empty($overviewCards) && !$reviewAccess['can_review'])
    <div class="card">
        <div class="empty-state">
            <i class="fa-solid fa-lock"></i>
            <p>Aucun contenu essentiel n est disponible sur ce dashboard pour votre profil.</p>
        </div>
    </div>
@endif
@endsection

@extends('admin.layouts.app')

@section('title', 'Parametres')
@section('breadcrumb', 'Parametres')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-sliders"></i> Parametres de contenu</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Hero, mission, valeurs, objectifs, contact et autres blocs dynamiques du site.</p>
        </div>
        <a href="{{ route('admin.site-settings.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Nouveau parametre</a>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Cle</th>
                        <th>Apercu</th>
                        <th>Mise a jour</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siteSettings as $siteSetting)
                        <tr>
                            <td><span class="badge badge-blue">{{ $siteSetting->key }}</span></td>
                            <td style="color:var(--gray-600);">{{ \Illuminate\Support\Str::limit(is_array(\App\Models\SiteSetting::decode($siteSetting->value)) ? json_encode(\App\Models\SiteSetting::decode($siteSetting->value)) : ($siteSetting->value ?? ''), 120) }}</td>
                            <td>{{ $siteSetting->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.site-settings.edit', $siteSetting) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form method="POST" action="{{ route('admin.site-settings.destroy', $siteSetting) }}" onsubmit="return confirm('Supprimer ce parametre ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4"><div class="empty-state"><i class="fa-solid fa-sliders"></i><p>Aucun parametre enregistre.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($siteSettings->hasPages())
    <div class="pagination">{{ $siteSettings->links() }}</div>
@endif
@endsection

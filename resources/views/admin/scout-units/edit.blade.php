@extends('admin.layouts.app')

@section('title', 'Modifier une unite')
@section('breadcrumb')
<a href="{{ route('admin.scout-units.index') }}">Unites</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-header">
        <div>
            <h2><i class="fa-solid fa-images"></i> Galerie de l unite</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Publiez et consultez les photos liees a {{ $scoutUnit->name }}.</p>
        </div>
        <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
            <span class="badge badge-purple">{{ $scoutUnit->gallery_items_count }} medias</span>
            <a href="{{ route('admin.gallery-items.index', ['scout_unit_id' => $scoutUnit->id]) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-images"></i> Voir la galerie</a>
            <a href="{{ route('admin.gallery-items.create', ['scout_unit_id' => $scoutUnit->id]) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-camera"></i> Ajouter une photo</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-pen-to-square"></i> Modifier {{ $scoutUnit->name }}</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.scout-units.update', $scoutUnit) }}">
            @csrf
            @method('PUT')
            @include('admin.scout-units._form')
        </form>
    </div>
</div>
@endsection

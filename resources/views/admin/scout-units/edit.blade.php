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
            <h2><i class="fa-solid fa-calendar-days"></i> Programme de l unite</h2>
            <p style="color:var(--gray-500);font-size:.84rem;margin-top:.25rem;">Gerez ici le programme journalier et les evenements lies a {{ $scoutUnit->name }}.</p>
        </div>
        <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
            <span class="badge badge-amber">{{ $scoutUnit->program_events_count }} evenements</span>
            <a href="{{ route('admin.program-events.index', ['scout_unit_id' => $scoutUnit->id]) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-calendar-days"></i> Voir le programme</a>
            <a href="{{ route('admin.program-events.create', ['scout_unit_id' => $scoutUnit->id]) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Ajouter un evenement</a>
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

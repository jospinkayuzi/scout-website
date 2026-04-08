@extends('admin.layouts.app')

@section('title', 'Nouveau parametre')
@section('breadcrumb')
<a href="{{ route('admin.site-settings.index') }}">Parametres</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Creer
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-plus"></i> Ajouter un parametre</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.site-settings.store') }}">
            @csrf
            @include('admin.site-settings._form', ['formattedValue' => old('value', '')])
        </form>
    </div>
</div>
@endsection

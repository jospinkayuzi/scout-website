@extends('admin.layouts.app')

@section('title', 'Modifier un parametre')
@section('breadcrumb')
<a href="{{ route('admin.site-settings.index') }}">Parametres</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-pen-to-square"></i> Modifier {{ $siteSetting->key }}</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.site-settings.update', $siteSetting) }}">
            @csrf
            @method('PUT')
            @include('admin.site-settings._form')
        </form>
    </div>
</div>
@endsection

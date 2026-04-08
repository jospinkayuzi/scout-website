@extends('admin.layouts.app')

@section('title', 'Nouvelle unite')
@section('breadcrumb')
<a href="{{ route('admin.scout-units.index') }}">Unites</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Creer
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-plus"></i> Ajouter une unite</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.scout-units.store') }}">
            @csrf
            @include('admin.scout-units._form')
        </form>
    </div>
</div>
@endsection

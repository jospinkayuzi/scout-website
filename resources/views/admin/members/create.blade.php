@extends('admin.layouts.app')

@section('title', 'Nouveau membre')
@section('breadcrumb')
<a href="{{ route('admin.members.index') }}">Membres</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Creer
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-plus"></i> Ajouter un membre</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.members.store') }}">
            @csrf
            @include('admin.members._form')
        </form>
    </div>
</div>
@endsection

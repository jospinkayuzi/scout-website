@extends('admin.layouts.app')

@section('title', 'Nouvelle publication')
@section('breadcrumb')
<a href="{{ route('admin.publications.index') }}">Publications</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Creer
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-plus"></i> Ajouter une publication</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.publications.store') }}">
            @csrf
            @include('admin.publications._form')
        </form>
    </div>
</div>
@endsection

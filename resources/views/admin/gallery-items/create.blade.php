@extends('admin.layouts.app')

@section('title', 'Nouveau media')
@section('breadcrumb')
<a href="{{ route('admin.gallery-items.index') }}">Galerie</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Creer
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-plus"></i> Ajouter un media</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.gallery-items.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.gallery-items._form')
        </form>
    </div>
</div>
@endsection

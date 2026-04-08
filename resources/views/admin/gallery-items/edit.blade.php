@extends('admin.layouts.app')

@section('title', 'Modifier un media')
@section('breadcrumb')
<a href="{{ route('admin.gallery-items.index') }}">Galerie</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-pen-to-square"></i> Modifier {{ $galleryItem->title }}</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.gallery-items.update', $galleryItem) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.gallery-items._form')
        </form>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Modifier une publication')
@section('breadcrumb')
<a href="{{ route('admin.publications.index') }}">Publications</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-pen-to-square"></i> Modifier {{ $publication->title }}</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.publications.update', $publication) }}">
            @csrf
            @method('PUT')
            @include('admin.publications._form')
        </form>
    </div>
</div>
@endsection

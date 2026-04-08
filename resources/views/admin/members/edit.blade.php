@extends('admin.layouts.app')

@section('title', 'Modifier un membre')
@section('breadcrumb')
<a href="{{ route('admin.members.index') }}">Membres</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-pen-to-square"></i> Modifier {{ $member->full_name }}</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.members.update', $member) }}">
            @csrf
            @method('PUT')
            @include('admin.members._form')
        </form>
    </div>
</div>
@endsection

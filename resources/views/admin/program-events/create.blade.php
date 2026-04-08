@extends('admin.layouts.app')

@section('title', 'Nouvel evenement')
@section('breadcrumb')
<a href="{{ route('admin.program-events.index') }}">Programme</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Creer
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-plus"></i> Ajouter un evenement</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.program-events.store') }}">
            @csrf
            @include('admin.program-events._form')
        </form>
    </div>
</div>
@endsection

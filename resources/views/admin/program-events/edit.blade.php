@extends('admin.layouts.app')

@section('title', 'Modifier un evenement')
@section('breadcrumb')
<a href="{{ route('admin.program-events.index') }}">Programme</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-pen-to-square"></i> Modifier {{ $programEvent->title }}</h2></div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.program-events.update', $programEvent) }}">
            @csrf
            @method('PUT')
            @include('admin.program-events._form')
        </form>
    </div>
</div>
@endsection

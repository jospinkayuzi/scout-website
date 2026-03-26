@extends('admin.layouts.app')

@section('title', 'Modifier le rôle')
@section('breadcrumb')
<a href="{{ route('admin.roles.index') }}">Rôles</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-shield-halved"></i> Modifier : {{ $role->name }}</h2>
    </div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nom du rôle *</label>
                    <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-input" required>
                    @error('name') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" value="{{ old('description', $role->description) }}" class="form-input">
                    @error('description') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-top:1.5rem;">
                <label class="form-label" style="margin-bottom:.75rem;display:block;font-size:.9rem;">
                    <i class="fa-solid fa-key"></i> Permissions attribuées
                </label>
                <div class="perm-grid">
                    @foreach($permissions as $perm)
                    <label class="perm-item">
                        <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                            {{ in_array($perm->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                        <div>
                            <div class="perm-name">{{ $perm->description }}</div>
                            <div class="perm-desc">{{ $perm->name }}</div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div style="margin-top:1.5rem;display:flex;gap:.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

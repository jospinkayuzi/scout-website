@extends('admin.layouts.app')

@section('title', 'Nouvel utilisateur')
@section('breadcrumb')
<a href="{{ route('admin.users.index') }}">Utilisateurs</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Créer
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-user-plus"></i> Créer un utilisateur</h2>
    </div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Nom de l'utilisateur" required>
                    @error('name') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Adresse e-mail *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="email@exemple.com" required>
                    @error('email') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Mot de passe *</label>
                    <input type="password" name="password" class="form-input" placeholder="Minimum 8 caractères" required>
                    @error('password') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe *</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Retapez le mot de passe" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle *</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">Sélectionner un rôle</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }} — {{ $role->description }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Créer l'utilisateur
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

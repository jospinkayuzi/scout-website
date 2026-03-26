@extends('admin.layouts.app')

@section('title', 'Modifier l\'utilisateur')
@section('breadcrumb')
<a href="{{ route('admin.users.index') }}">Utilisateurs</a>
<i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
Modifier
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-user-pen"></i> Modifier : {{ $user->name }}</h2>
    </div>
    <div class="card-body padded">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                    @error('name') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Adresse e-mail *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                    @error('email') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-input" placeholder="Laisser vide pour ne pas changer">
                    @error('password') <span class="form-error">{{ $message }}</span> @enderror
                    <span class="form-hint">Laisser vide pour conserver le mot de passe actuel</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Retapez le nouveau mot de passe">
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle *</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">Sélectionner un rôle</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }} — {{ $role->description }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div style="margin-top:1.5rem;display:flex;gap:.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

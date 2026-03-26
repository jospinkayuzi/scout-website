<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'voir_tableau_bord', 'description' => 'Voir le tableau de bord'],
            ['name' => 'gerer_utilisateurs', 'description' => 'Gérer les utilisateurs'],
            ['name' => 'gerer_roles', 'description' => 'Gérer les rôles et permissions'],
            ['name' => 'gerer_membres', 'description' => 'Gérer les membres / inscriptions'],
            ['name' => 'gerer_publications', 'description' => 'Gérer les publications'],
            ['name' => 'gerer_galerie', 'description' => 'Gérer la galerie média'],
            ['name' => 'gerer_parametres', 'description' => 'Gérer les paramètres du site'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm['name']], $perm);
        }

        $allPermissions = Permission::all();

        $superAdmin = Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['description' => 'Accès complet à toutes les fonctionnalités']
        );
        $superAdmin->permissions()->sync($allPermissions->pluck('id'));

        $admin = Role::firstOrCreate(
            ['name' => 'Administrateur'],
            ['description' => 'Gestion complète sauf les rôles']
        );
        $admin->permissions()->sync(
            $allPermissions->whereNotIn('name', ['gerer_roles'])->pluck('id')
        );

        $editeur = Role::firstOrCreate(
            ['name' => 'Éditeur'],
            ['description' => 'Gestion des publications et de la galerie']
        );
        $editeur->permissions()->sync(
            $allPermissions->whereIn('name', ['voir_tableau_bord', 'gerer_publications', 'gerer_galerie'])->pluck('id')
        );

        $membre = Role::firstOrCreate(
            ['name' => 'Membre'],
            ['description' => 'Accès en lecture seule au tableau de bord']
        );
        $membre->permissions()->sync(
            $allPermissions->whereIn('name', ['voir_tableau_bord'])->pluck('id')
        );

        if (!User::where('email', 'admin@gsn.bi')->exists()) {
            User::create([
                'name' => 'Administrateur',
                'email' => 'admin@gsn.bi',
                'password' => Hash::make('password123'),
                'role_id' => $superAdmin->id,
            ]);
        }
    }
}

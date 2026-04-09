<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\Member;
use App\Models\Permission;
use App\Models\Role;
use App\Models\ScoutUnit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_group_chief_can_access_gallery_creation(): void
    {
        $user = $this->createGalleryUser('chef.groupe@example.com');
        Member::create([
            'first_name' => 'Chef',
            'last_name' => 'Groupe',
            'email' => 'chef.groupe@example.com',
            'birth_date' => '1990-01-01',
            'status' => 'active',
            'member_function' => 'Cheffe de Groupe',
        ]);

        $response = $this->actingAs($user)->get(route('admin.gallery-items.create'));

        $response->assertOk();
    }

    public function test_unit_chief_cannot_edit_gallery_item_of_another_unit(): void
    {
        $meute = ScoutUnit::create([
            'name' => 'Meute',
            'slug' => 'meute',
            'age_range' => '6 - 11 ans',
            'short_description' => 'Meute',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $troupe = ScoutUnit::create([
            'name' => 'Troupe F',
            'slug' => 'troupe-f',
            'age_range' => '12 - 15 ans',
            'short_description' => 'Troupe F',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $user = $this->createGalleryUser('akela@example.com');
        Member::create([
            'scout_unit_id' => $meute->id,
            'first_name' => 'Akela',
            'last_name' => 'Meute',
            'email' => 'akela@example.com',
            'birth_date' => '1991-02-02',
            'status' => 'active',
            'member_function' => "Akela (Chef d'unité Meute)",
        ]);

        $galleryItem = GalleryItem::create([
            'scout_unit_id' => $troupe->id,
            'title' => 'Camp Troupe',
            'media_type' => 'image',
            'media_path' => 'https://example.com/photo.jpg',
        ]);

        $response = $this->actingAs($user)->get(route('admin.gallery-items.edit', $galleryItem));

        $response->assertForbidden();
    }

    public function test_user_with_gallery_permission_but_without_chief_function_is_forbidden(): void
    {
        $user = $this->createGalleryUser('membre@example.com');
        Member::create([
            'first_name' => 'Simple',
            'last_name' => 'Membre',
            'email' => 'membre@example.com',
            'birth_date' => '1998-03-03',
            'status' => 'active',
            'member_function' => 'Membre',
        ]);

        $response = $this->actingAs($user)->get(route('admin.gallery-items.create'));

        $response->assertForbidden();
    }

    private function createGalleryUser(string $email): User
    {
        $permission = Permission::create([
            'name' => 'gerer_galerie',
            'description' => 'Gerer la galerie',
        ]);

        $dashboardPermission = Permission::create([
            'name' => 'voir_tableau_bord',
            'description' => 'Voir le tableau de bord',
        ]);

        $role = Role::create([
            'name' => 'Gestion Galerie',
            'description' => 'Acces galerie',
        ]);

        $role->permissions()->attach([$permission->id, $dashboardPermission->id]);

        return User::factory()->create([
            'email' => $email,
            'role_id' => $role->id,
        ]);
    }
}

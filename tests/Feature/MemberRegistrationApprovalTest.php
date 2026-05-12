<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Permission;
use App\Models\Role;
use App\Models\ScoutUnit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberRegistrationApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_unit_chief_can_approve_pending_member_of_own_unit_from_dashboard(): void
    {
        $meute = $this->createUnit('Meute', 'meute', 1);
        $user = $this->createDashboardUser('akela@example.com');

        Member::create([
            'scout_unit_id' => $meute->id,
            'first_name' => 'Akela',
            'last_name' => 'Chef',
            'email' => 'akela@example.com',
            'birth_date' => '1990-01-01',
            'status' => 'active',
            'member_function' => "Akela (Chef d'unité Meute)",
        ]);

        $pendingMember = Member::create([
            'scout_unit_id' => $meute->id,
            'first_name' => 'Aline',
            'last_name' => 'Niyonzima',
            'birth_date' => now()->subYears(10)->toDateString(),
            'status' => 'pending',
            'member_function' => 'Membre',
            'registered_at' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)
            ->from(route('admin.dashboard'))
            ->post(route('admin.members.approve', $pendingMember));

        $response->assertRedirect(route('admin.dashboard'));

        $pendingMember->refresh();

        $this->assertSame('active', $pendingMember->status);
        $this->assertNotNull($pendingMember->approved_at);
    }

    public function test_unit_chief_cannot_approve_pending_member_of_another_unit(): void
    {
        $meute = $this->createUnit('Meute', 'meute', 1);
        $troupe = $this->createUnit('Troupe F', 'troupe-f', 2);
        $user = $this->createDashboardUser('akela@example.com');

        Member::create([
            'scout_unit_id' => $meute->id,
            'first_name' => 'Akela',
            'last_name' => 'Chef',
            'email' => 'akela@example.com',
            'birth_date' => '1990-01-01',
            'status' => 'active',
            'member_function' => "Akela (Chef d'unité Meute)",
        ]);

        $pendingMember = Member::create([
            'scout_unit_id' => $troupe->id,
            'first_name' => 'Grace',
            'last_name' => 'Irakoze',
            'birth_date' => now()->subYears(14)->toDateString(),
            'status' => 'pending',
            'member_function' => 'Membre',
            'registered_at' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)
            ->post(route('admin.members.approve', $pendingMember));

        $response->assertForbidden();
        $this->assertSame('pending', $pendingMember->fresh()->status);
    }

    public function test_dashboard_shows_only_pending_registrations_for_the_unit_chief_unit(): void
    {
        $meute = $this->createUnit('Meute', 'meute', 1);
        $troupe = $this->createUnit('Troupe F', 'troupe-f', 2);
        $user = $this->createDashboardUser('akela@example.com');

        Member::create([
            'scout_unit_id' => $meute->id,
            'first_name' => 'Akela',
            'last_name' => 'Chef',
            'email' => 'akela@example.com',
            'birth_date' => '1990-01-01',
            'status' => 'active',
            'member_function' => "Akela (Chef d'unité Meute)",
        ]);

        Member::create([
            'scout_unit_id' => $meute->id,
            'first_name' => 'Uniqueown',
            'last_name' => 'Member',
            'birth_date' => now()->subYears(9)->toDateString(),
            'status' => 'pending',
            'member_function' => 'Membre',
            'registered_at' => now()->toDateString(),
        ]);

        Member::create([
            'scout_unit_id' => $troupe->id,
            'first_name' => 'Uniqueother',
            'last_name' => 'Member',
            'birth_date' => now()->subYears(14)->toDateString(),
            'status' => 'pending',
            'member_function' => 'Membre',
            'registered_at' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('Uniqueown Member');
        $response->assertDontSee('Uniqueother Member');
    }

    public function test_member_manager_with_permission_can_still_approve_without_being_unit_chief(): void
    {
        $unit = $this->createUnit('Grappe', 'grappe', 1);
        $user = $this->createMemberManagerUser('manager@example.com');

        $pendingMember = Member::create([
            'scout_unit_id' => $unit->id,
            'first_name' => 'Kevin',
            'last_name' => 'Ndikuriyo',
            'birth_date' => now()->subYears(17)->toDateString(),
            'status' => 'pending',
            'member_function' => 'Membre',
            'registered_at' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)
            ->from(route('admin.members.index'))
            ->post(route('admin.members.approve', $pendingMember));

        $response->assertRedirect(route('admin.members.index'));
        $this->assertSame('active', $pendingMember->fresh()->status);
    }

    private function createUnit(string $name, string $slug, int $sortOrder): ScoutUnit
    {
        return ScoutUnit::create([
            'name' => $name,
            'slug' => $slug,
            'age_range' => 'Test',
            'short_description' => $name,
            'sort_order' => $sortOrder,
            'is_active' => true,
        ]);
    }

    private function createDashboardUser(string $email): User
    {
        $dashboardPermission = Permission::create([
            'name' => 'voir_tableau_bord',
            'description' => 'Voir le tableau de bord',
        ]);

        $role = Role::create([
            'name' => 'Chef Unite',
            'description' => 'Acces au dashboard',
        ]);

        $role->permissions()->attach($dashboardPermission->id);

        return User::factory()->create([
            'email' => $email,
            'role_id' => $role->id,
        ]);
    }

    private function createMemberManagerUser(string $email): User
    {
        $dashboardPermission = Permission::create([
            'name' => 'voir_tableau_bord',
            'description' => 'Voir le tableau de bord',
        ]);

        $membersPermission = Permission::create([
            'name' => 'gerer_membres',
            'description' => 'Gerer les membres',
        ]);

        $role = Role::create([
            'name' => 'Gestion Membres',
            'description' => 'Acces membres',
        ]);

        $role->permissions()->attach([$dashboardPermission->id, $membersPermission->id]);

        return User::factory()->create([
            'email' => $email,
            'role_id' => $role->id,
        ]);
    }
}

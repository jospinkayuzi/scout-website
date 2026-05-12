<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\ScoutUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_creates_a_pending_member_with_registration_details(): void
    {
        $unit = ScoutUnit::create([
            'name' => 'Meute',
            'slug' => 'meute',
            'age_range' => '6 - 11 ans',
            'short_description' => 'Meute',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->post(route('members.register'), [
            'first_name' => 'Aline',
            'last_name' => 'Niyonzima',
            'totem' => 'Gazelle',
            'birth_date' => now()->subYears(10)->toDateString(),
            'gender' => 'Feminin',
            'address' => 'Quartier Rohero, Bujumbura',
            'parent_name' => 'Marie Niyonzima',
            'guardian_relationship' => 'Mere',
            'guardian_phone' => '+25779000000',
            'motivation' => 'Je souhaite apprendre la vie scoute et servir avec mon equipe.',
        ]);

        $response->assertRedirect(route('site.join'));
        $response->assertSessionHas('success');

        $member = Member::first();

        $this->assertNotNull($member);
        $this->assertSame('Aline', $member->first_name);
        $this->assertSame('Niyonzima', $member->last_name);
        $this->assertSame('Gazelle', $member->totem);
        $this->assertSame('Feminin', $member->gender);
        $this->assertSame('Marie Niyonzima', $member->parent_name);
        $this->assertSame('Mere', $member->guardian_relationship);
        $this->assertSame('+25779000000', $member->guardian_phone);
        $this->assertSame('pending', $member->status);
        $this->assertSame('Membre', $member->member_function);
        $this->assertSame(now()->subYears(10)->toDateString(), $member->birth_date->toDateString());
    }

    public function test_public_registration_requires_parent_name_and_guardian_phone_for_meute_and_troupe(): void
    {
        ScoutUnit::create([
            'name' => 'Troupe F',
            'slug' => 'troupe-f',
            'age_range' => '12 - 15 ans',
            'short_description' => 'Troupe F',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->from(route('site.join'))->post(route('members.register'), [
            'first_name' => 'Grace',
            'last_name' => 'Irakoze',
            'birth_date' => now()->subYears(14)->toDateString(),
            'gender' => 'Feminin',
        ]);

        $response->assertRedirect(route('site.join'));
        $response->assertSessionHasErrors([
            'parent_name',
            'guardian_phone',
        ]);
        $response->assertSessionDoesntHaveErrors([
            'guardian_relationship',
        ]);
    }

    public function test_public_registration_rejects_a_unit_that_does_not_match_the_age(): void
    {
        ScoutUnit::create([
            'name' => 'Meute',
            'slug' => 'meute',
            'age_range' => '6 - 11 ans',
            'short_description' => 'Meute',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $route = ScoutUnit::create([
            'name' => 'Route',
            'slug' => 'route',
            'age_range' => '19 - 23 ans',
            'short_description' => 'Route',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $response = $this->from(route('site.join'))->post(route('members.register'), [
            'scout_unit_id' => $route->id,
            'first_name' => 'Aline',
            'last_name' => 'Niyonzima',
            'birth_date' => now()->subYears(10)->toDateString(),
            'gender' => 'Feminin',
            'phone' => '+25779000000',
            'parent_name' => 'Marie Niyonzima',
            'guardian_relationship' => 'Mere',
            'guardian_phone' => '+25779000001',
        ]);

        $response->assertRedirect(route('site.join'));
        $response->assertSessionHasErrors(['scout_unit_id']);
        $this->assertDatabaseCount('members', 0);
    }

    public function test_join_page_recreates_default_units_when_database_is_empty(): void
    {
        $this->assertDatabaseCount('scout_units', 0);

        $response = $this->get(route('site.join'));

        $response->assertOk();
        $this->assertGreaterThan(0, ScoutUnit::query()->count());
        $this->assertNotNull(ScoutUnit::query()->where('slug', 'meute')->first());
    }

    public function test_public_registration_works_with_default_units_recreated_from_empty_database(): void
    {
        $this->assertDatabaseCount('scout_units', 0);

        $response = $this->post(route('members.register'), [
            'first_name' => 'Aline',
            'last_name' => 'Niyonzima',
            'birth_date' => now()->subYears(10)->toDateString(),
            'gender' => 'Feminin',
            'parent_name' => 'Marie Niyonzima',
            'guardian_relationship' => 'Mere',
            'guardian_phone' => '+25779000000',
        ]);

        $response->assertRedirect(route('site.join'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('members', [
            'first_name' => 'Aline',
            'last_name' => 'Niyonzima',
        ]);
        $this->assertNotNull(ScoutUnit::query()->where('slug', 'meute')->first());
    }
}

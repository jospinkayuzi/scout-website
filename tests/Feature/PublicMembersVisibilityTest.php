<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\ScoutUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicMembersVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_members_page_only_shows_approved_members_in_public_lists(): void
    {
        $unit = ScoutUnit::create([
            'name' => 'Meute',
            'slug' => 'meute',
            'age_range' => '6 - 11 ans',
            'short_description' => 'Meute',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Member::create([
            'scout_unit_id' => $unit->id,
            'first_name' => 'Aline',
            'last_name' => 'Active',
            'birth_date' => '2014-01-01',
            'status' => 'active',
            'member_function' => 'Membre',
            'registered_at' => now()->toDateString(),
        ]);

        Member::create([
            'scout_unit_id' => $unit->id,
            'first_name' => 'Paula',
            'last_name' => 'Pending',
            'birth_date' => '2014-01-01',
            'status' => 'pending',
            'member_function' => 'Membre',
            'registered_at' => now()->toDateString(),
        ]);

        $response = $this->get(route('site.members'));

        $response->assertOk();
        $response->assertSee('Aline Active');
        $response->assertDontSee('Paula Pending');
        $response->assertSee('Validation dans le dashboard');
    }
}

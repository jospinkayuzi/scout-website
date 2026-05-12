<?php

namespace Tests\Feature;

use App\Models\ScoutUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitPlannedActivitiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_program_page_shows_planned_unit_activities(): void
    {
        ScoutUnit::create([
            'name' => 'Lutins',
            'slug' => 'lutins',
            'age_range' => '6 - 8 ans',
            'short_description' => 'Les lutins.',
            'schedule' => 'Samedi matin',
            'planned_activities' => [
                [
                    'name' => 'Jeu de piste',
                    'responsible' => 'Cheftaine Aline',
                    'time' => '09h00 - 10h30',
                ],
                [
                    'name' => 'Chants scouts',
                    'responsible' => 'Cheftaine Grace',
                    'time' => '10h45 - 11h30',
                ],
            ],
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get(route('site.program'));

        $response->assertOk();
        $response->assertSee('Jeu de piste');
        $response->assertSee('Cheftaine Aline');
        $response->assertSee('09h00 - 10h30');
        $response->assertSee('Chants scouts');
        $response->assertSee('Cheftaine Grace');
        $response->assertSee('10h45 - 11h30');
    }
}

<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_about_page_redirects_to_the_homepage_anchor(): void
    {
        $response = $this->get('/a-propos');

        $response->assertRedirect('/#a-propos');
    }
}

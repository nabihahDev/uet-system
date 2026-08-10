<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BafRequestFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_request_form_shows_wireframe_sections(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/requests/create');

        $response->assertStatus(200)
            ->assertSeeText('Create New Requisition')
            ->assertSeeText('1. General Information')
            ->assertSeeText('2. Requested Items')
            ->assertSeeText('3. Justification & Delivery')
            ->assertSeeText('4. Review & Sign');
    }
}

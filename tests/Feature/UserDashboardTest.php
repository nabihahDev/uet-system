<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ujian 1: Pengguna boleh melihat Papan Pemuka UET
     */
    public function test_user_dashboard_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('uet.dashboard'));

        $response
            ->assertOk()
            ->assertSee('Papan Pemuka Pemohon')
            ->assertSee('Senarai Permohonan UET');
    }

    /**
     * Ujian 2: Pengguna boleh mengakses halaman borang permohonan UET baru
     */
    public function test_user_can_access_uet_form_page(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('uet.create'));

        $response
            ->assertOk()
            ->assertSee('Borang UET')
            ->assertSee('Permohonan Baru');
    }
}
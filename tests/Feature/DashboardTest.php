<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function testAccessDashboardAsUser(): void
    {
        $user = User::factory()->create([
            'name' => 'test_user',
            'email' => 'test_user@example.com',
            'is_admin' => null,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertStatus(200);
    }

    public function testAccessDashboardAsAdmin(): void
    {
        $user = User::factory()->create([
            'name' => 'test_admin',
            'email' => 'test_admin@example.com',
            'is_admin' => 1,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertStatus(200);
    }
}

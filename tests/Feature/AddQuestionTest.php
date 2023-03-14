<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function testRestrictQuestionsAsUser(): void
    {
        $user = User::factory()->create([
            'name' => 'test_user',
            'email' => 'test_user@example.com',
            'is_admin' => null,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/questions');

        $response->assertStatus(404);
    }

    public function testAccessQuestionsAsAdmin(): void
    {
        $user = User::factory()->create([
            'name' => 'test_admin',
            'email' => 'test_admin@example.com',
            'is_admin' => 1,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/questions');

        $response->assertStatus(200);
    }

    public function testAddQuestionsAsAdmin(): void
    {
        $admin = User::factory()->create([
            'name' => 'test_admin',
            'email' => 'test_admin@example.com',
            'is_admin' => 1,
        ]);

        $response = $this
            ->actingAs($admin)
            ->get('/questions');

        $response->assertStatus(200);
    }

    public function testRestrictAddQuestionsAsUser(): void
    {
        $user = User::factory()->create([
            'name' => 'test_admin',
            'email' => 'test_admin@example.com',
            'is_admin' => null,
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/questions');

        $response->assertStatus(404);
    }
}

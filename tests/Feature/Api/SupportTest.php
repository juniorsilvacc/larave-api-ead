<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Support;
use Tests\TestCase;

class SupportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use UtilsTrait;

    public function testGetMySupportsUnauthenticated(): void
    {
        $response = $this->getJson('/my-supports');

        $response->assertStatus(401);
    }

    public function testGetMySupports(): void
    {
        $user = $this->createUser();
        $token = $user->createToken('teste')->plainTextToken;

        Support::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);

        Support::factory()->count(50)->create();

        $response = $this->getJson('/my-supports', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(50, 'data');
    }

    public function testGetSupportsUnauthenticated(): void
    {
        $response = $this->getJson('/supports');

        $response->assertStatus(401);
    }

    public function testGetSupports(): void
    {
        Support::factory()->count(50)->create();

        $response = $this->getJson('/supports', $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(50, 'data');
    }

    public function testGetSupportsFilterLesson(): void
    {
        $lesson = Lesson::factory()->create();

        Support::factory()->count(50)->create();
        Support::factory()->count(10)->create([
            'lesson_id' => $lesson->id,
        ]);

        $payload = [
            'lesson' => $lesson->id,
        ];

        $response = $this->json('GET', '/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function testGetSupportsFilterStatus(): void
    {
        Support::factory()->count(25)->create([
            'status' => 'P',
        ]);
        Support::factory()->count(5)->create([
            'status' => 'C',
        ]);

        $payload = [
            'status' => 'C',
        ];

        $response = $this->json('GET', '/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    public function testGetSupportsFilterLikeDescription(): void
    {
        Support::factory()->count(20)->create([
            'description' => 'Teste aula 01',
        ]);
        Support::factory()->count(10)->create([
            'description' => 'Outra aula 02',
        ]);

        $payload = [
            'filter' => 'Teste',
        ];

        $response = $this->json('GET', '/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(20, 'data');
    }

    public function testGetSupportsLessonTotal(): void
    {
        Support::factory()->count(50)->create();
        Support::factory()->count(10)->create();

        $payload = [
        ];

        $response = $this->json('GET', '/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(60, 'data');
    }

    public function testCreateSupportUnauthenticated(): void
    {
        $response = $this->postJson('/supports');

        $response->assertStatus(401);
    }

    public function testCreateSupportErrorValidator(): void
    {
        $payload = [
        ];

        $response = $this->postJson('/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function testCreateSupportInvalidValidator(): void
    {
        $payload = [
            'description' => 'Teste',
            'lesson' => 'id_lesson_fake',
            'status' => 'P',
        ];

        $response = $this->postJson('/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function testCreateSupport(): void
    {
        $lesson = Lesson::factory()->create();

        $payload = [
            'description' => 'Teste',
            'lesson' => $lesson->id,
            'status' => 'P',
        ];

        $response = $this->postJson('/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(201);
    }
}

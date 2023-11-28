<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use UtilsTrait;

    public function testMakeViewedUnauthenticated(): void
    {
        $response = $this->postJson('/lessons/viewed');

        $response->assertStatus(401);
    }

    public function testMakeViewedErrorValidator(): void
    {
        $payload = [];

        $response = $this->postJson(
            '/lessons/viewed',
            $payload,
            $this->defaultHeaders()
        );

        $response->assertStatus(422);
    }

    public function testMakeViewedInvalidValidator(): void
    {
        $payload = [
            'lesson' => 'id_lesson_fake',
        ];

        $response = $this->postJson(
            '/lessons/viewed',
            $payload,
            $this->defaultHeaders()
        );

        $response->assertStatus(422);
    }

    public function testMakeViewed(): void
    {
        $lesson = Lesson::factory()->create();

        $payload = [
            'lesson' => $lesson->id,
        ];

        $response = $this->postJson(
            '/lessons/viewed',
            $payload,
            $this->defaultHeaders()
        );

        $response->assertStatus(200);
    }
}

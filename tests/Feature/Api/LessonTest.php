<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Module;
use Tests\TestCase;

class LessonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use UtilsTrait;

    public function testGetLessonsModuleUnauthenticated(): void
    {
        $response = $this->getJson('/modules/unauthenticated/lessons');

        $response->assertStatus(401);
    }

    public function testGetLessonsModuleNotFound(): void
    {
        $response = $this->getJson('/modules/not_found/lessons', $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function testGetLessonsModule(): void
    {
        $module = Module::factory()->create();

        $response = $this->getJson("/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function testGetLessonsModuleTotal(): void
    {
        $module = Module::factory()->create();
        Lesson::factory()->count(10)->create([
            'module_id' => $module->id,
        ]);

        $response = $this->getJson("/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function testGetLessonUnauthenticated(): void
    {
        $response = $this->getJson('/lessons/unauthenticated');

        $response->assertStatus(401);
    }

    public function testGetLessonNotFound(): void
    {
        $response = $this->getJson('/lessons/not_found', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function testGetLesson(): void
    {
        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/lessons/{$lesson->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }
}

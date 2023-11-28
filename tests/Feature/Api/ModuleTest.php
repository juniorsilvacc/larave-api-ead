<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use UtilsTrait;

    public function testGetModulesCourseUnauthenticated(): void
    {
        $course = Course::factory()->create();

        $response = $this->getJson('/courses/unauthenticated/modules');

        $response->assertStatus(401);
    }

    public function testGetModulesCourseNotFound(): void
    {
        $response = $this->getJson('/courses/not_found/modules', $this->defaultHeaders());

        // Ou 404 e no repository fazer a implementação do findOrFail
        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function testGetModulesCourse(): void
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function testGetModulesCourseTotal(): void
    {
        $course = Course::factory()->create();
        Module::factory()->count(10)->create([
            'course_id' => $course->id,
        ]);

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
}

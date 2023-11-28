<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Tests\TestCase;

class CourseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use UtilsTrait;

    public function testCoursesUnauthenticated(): void
    {
        $response = $this->getJson('/courses');

        $response->assertStatus(401);
    }

    public function testGetCourses(): void
    {
        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function testGetAllCoursesTotal()
    {
        $courses = Course::factory()->count(10)->create();

        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(count($courses), 'data');
    }

    public function testGetSingleCourseUnauthenticated()
    {
        $response = $this->getJson('/courses/unauthenticated');

        $response->assertStatus(401);
    }

    public function testGetSingleCourseNotFound()
    {
        $response = $this->getJson('/courses/fake_id', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function testGetSingleCourse()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }
}

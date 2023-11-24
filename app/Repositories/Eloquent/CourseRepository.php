<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use App\Repositories\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    private $model;

    public function __construct(
        Course $model
    ) {
        $this->model = $model;
    }

    public function getAllCourses()
    {
        $courses = $this->model->with('modules.lessons.views')->get();

        return $courses;
    }

    public function getCourse(string $id)
    {
        $course = $this->model->with('modules.lessons')->findOrFail($id);

        return $course;
    }
}

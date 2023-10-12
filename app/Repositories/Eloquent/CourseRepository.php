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
        $courses = $this->model->get();

        return $courses;
    }

    public function getCourse($id)
    {
        $course = $this->model->findOrFail($id);

        return $course;
    }
}

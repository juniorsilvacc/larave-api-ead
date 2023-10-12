<?php

namespace App\Repositories;

interface CourseRepositoryInterface
{
    public function getAllCourses();

    public function getCourse(string $id);
}

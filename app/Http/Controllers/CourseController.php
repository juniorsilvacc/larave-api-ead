<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Repositories\Eloquent\CourseRepository;

class CourseController extends Controller
{
    private $repository;

    public function __construct(
        CourseRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function index()
    {
        $courses = $this->repository->getAllCourses();

        return CourseResource::collection($courses);
    }

    public function show($id)
    {
        $course = $this->repository->getCourse($id);

        return new CourseResource($course);
    }
}

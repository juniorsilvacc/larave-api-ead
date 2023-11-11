<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateView;
use App\Http\Resources\LessonResource;
use App\Repositories\Eloquent\LessonRepository;

class LessonController extends Controller
{
    private $repository;

    public function __construct(
        LessonRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function index($moduleId)
    {
        $lessons = $this->repository->getLessonsByModuleId($moduleId);

        return LessonResource::collection($lessons);
    }

    public function show($id)
    {
        $lesson = $this->repository->getLesson($id);

        return new LessonResource($lesson);
    }

    public function viewed(CreateView $request)
    {
        $this->repository->markLessonViewed($request->lesson);

        return response()->json(['success' => true]);
    }
}

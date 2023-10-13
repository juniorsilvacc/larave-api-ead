<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use App\Repositories\LessonRepositoryInterface;

class LessonRepository implements LessonRepositoryInterface
{
    private $model;

    public function __construct(
        Lesson $model
    ) {
        $this->model = $model;
    }

    public function getLessonsByModuleId(string $moduleId)
    {
        $lessons = $this->model
            ->where('module_id', $moduleId)
            ->get();

        return $lessons;
    }

    public function getLesson(string $id)
    {
        $lesson = $this->model->findOrFail($id);

        return $lesson;
    }
}

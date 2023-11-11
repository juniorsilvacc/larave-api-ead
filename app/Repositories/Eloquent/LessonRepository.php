<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use App\Repositories\LessonRepositoryInterface;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository implements LessonRepositoryInterface
{
    use RepositoryTrait;

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

    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if ($view) {
            return $view->update([
                'qty' => $view->qty + 1,
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId,
        ]);
    }
}

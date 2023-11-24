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
            ->with('supports.replies')
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
        // Obtém o usuário autenticado
        $user = $this->getUserAuth();

        // Procura por uma visualização existente da lição para o usuário autenticado
        $view = $user->views()->where('lesson_id', $lessonId)->first();

        // Verifica se uma visualização já existe
        if ($view) {
            // Se a lição já foi vista, incrementa a quantidade de visualizações
            return $view->update([
                'qty' => $view->qty + 1,
            ]);
        }

        // Se a lição ainda não foi vista, cria uma nova entrada no banco de dados
        return $user->views()->create([
            'lesson_id' => $lessonId,
        ]);
    }
}

<?php

namespace App\Repositories;

interface LessonRepositoryInterface
{
    public function getLessonsByModuleId(string $moduleId);

    public function getLesson(string $id);
}

<?php

namespace App\Repositories\Eloquent;

use App\Models\Module;
use App\Repositories\ModuleRepositoryInterface;

class ModuleRepository implements ModuleRepositoryInterface
{
    private $model;

    public function __construct(
        Module $model
    ) {
        $this->model = $model;
    }

    public function getModulesCourseById(string $courseId)
    {
        $modules = $this->model
            ->with('lessons.views')
            ->where('course_id', $courseId)
            ->get();

        return $modules;
    }
}

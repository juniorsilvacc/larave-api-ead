<?php

namespace App\Repositories;

interface ModuleRepositoryInterface
{
    public function getModulesCourseById(string $courseId);
}

<?php

namespace App\Repositories;

interface ModuleRepositoryInterface
{
    public function getModuleCourseById(string $courseId);
}

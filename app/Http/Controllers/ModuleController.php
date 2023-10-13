<?php

namespace App\Http\Controllers;

use App\Http\Resources\ModuleResource;
use App\Repositories\Eloquent\ModuleRepository;

class ModuleController extends Controller
{
    private $repository;

    public function __construct(
        ModuleRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function index($courseId)
    {
        $modules = $this->repository->getModuleCourseById($courseId);

        return ModuleResource::collection($modules);
    }
}

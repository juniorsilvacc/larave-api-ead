<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupportResource;
use App\Repositories\Eloquent\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    private $repository;

    public function __construct(
        SupportRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $modules = $this->repository->getAll($request->all());

        return SupportResource::collection($modules);
    }
}

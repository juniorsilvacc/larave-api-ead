<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReplySupportRequest;
use App\Http\Resources\ReplyResource;
use App\Repositories\Eloquent\ReplySupportRepository;

class ReplySupportController extends Controller
{
    private $repository;

    public function __construct(
        ReplySupportRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function createReply(CreateReplySupportRequest $request)
    {
        $reply = $this->repository->createReplyToSupport($request->validated());

        return new ReplyResource($reply);
    }
}

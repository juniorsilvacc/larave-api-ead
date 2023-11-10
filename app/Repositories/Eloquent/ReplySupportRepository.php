<?php

namespace App\Repositories\Eloquent;

use App\Models\ReplySupport;
use App\Repositories\RepplySupportRepositoryInterface;
use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository implements RepplySupportRepositoryInterface
{
    use RepositoryTrait;

    private $model;

    public function __construct(
        ReplySupport $model
    ) {
        $this->model = $model;
    }

    public function createReplyToSupport(array $data)
    {
        $user = $this->getUserAuth();

        return $this->model
            ->create([
                'support_id' => $data['support'],
                'description' => $data['description'],
                'user_id' => $user->id,
            ]);
    }
}

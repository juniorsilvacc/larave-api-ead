<?php

namespace App\Repositories\Eloquent;

use App\Models\Support;
use App\Repositories\SupportRepositoryInterface;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository implements SupportRepositoryInterface
{
    use RepositoryTrait;

    private $model;

    public function __construct(
        Support $model
    ) {
        $this->model = $model;
    }

    private function getSupport(string $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getMySupports(array $filters = [])
    {
        $filters['user'] = true;

        return $this->getSupports($filters);
    }

    public function getSupports(array $filters = [])
    {
        return $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['filter'])) {
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }

                if (isset($filters['user'])) {
                    $user = $this->getUserAuth();

                    $query->where('user_id', $user->id);
                }
            })
            ->orderBy('updated_at')
            ->get();
    }

    public function createSupport(array $data)
    {
        $support = $this->getUserAuth()->supports()->create([
            'lesson_id' => $data['lesson'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);

        return $support;
    }

    public function createReplyToSupportId(array $data, string $supportId)
    {
        $user = $this->getUserAuth();

        $this->getSupport($supportId)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id,
            ]);
    }
}

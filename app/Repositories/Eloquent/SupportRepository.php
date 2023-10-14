<?php

namespace App\Repositories\Eloquent;

use App\Models\Support;
use App\Models\User;
use App\Repositories\SupportRepositoryInterface;

class SupportRepository implements SupportRepositoryInterface
{
    private $model;

    public function __construct(
        Support $model
    ) {
        $this->model = $model;
    }

    private function getUserAuth(): User
    {
        // return auth()->user();
        return User::first();
    }

    public function getAll(array $filters = [])
    {
        return $this->getUserAuth()
            ->supports()
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
            })
            ->get();
    }
}

<?php

namespace App\Repositories;

interface SupportRepositoryInterface
{
    public function getSupports(array $filters = []);

    public function createSupport(array $data);

    public function createReplyToSupportId(array $data, string $supportId);
}

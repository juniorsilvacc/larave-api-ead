<?php

namespace App\Repositories;

interface SupportRepositoryInterface
{
    public function getAll(array $filters = []);
}

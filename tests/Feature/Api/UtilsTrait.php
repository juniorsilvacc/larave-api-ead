<?php

namespace Tests\Feature\Api;

use App\Models\User;

trait UtilsTrait
{
    /**
     * A basic feature test example.
     */
    public function createUser()
    {
        $user = User::factory()->create();

        return $user;
    }

    public function createTokenUser()
    {
        $user = $this->createUser();

        $token = $user->createToken('teste')->plainTextToken;

        return $token;
    }
}

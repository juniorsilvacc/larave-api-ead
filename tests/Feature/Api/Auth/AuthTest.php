<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use UtilsTrait;

    public function testFailAuth(): void
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    public function testAuth(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'test',
        ]);

        $response->assertStatus(200);
    }

    public function testErroLogout(): void
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    public function testLogout(): void
    {
        $token = $this->createTokenUser();

        $response = $this->postJson('/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }

    public function testErroGetMe(): void
    {
        $response = $this->getJson('/me');

        $response->assertStatus(401);
    }

    public function testGetMe(): void
    {
        $token = $this->createTokenUser();

        $response = $this->getJson('/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use UtilsTrait;

    public function testCreateReplyUnauthenticated(): void
    {
        $response = $this->postJson('/replies');

        $response->assertStatus(401);
    }

    public function testCreateReplyErrorValidator(): void
    {
        $payload = [];

        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function testCreateReplyInvalidValidator(): void
    {
        $payload = [
            'description' => 'Teste',
            'support' => 'id_support_fake',
        ];

        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());

        $response->assertStatus(422);
    }

    public function testCreateReply(): void
    {
        $support = Support::factory()->create();

        $payload = [
            'description' => 'Teste',
            'support' => $support->id,
        ];

        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());

        $response->assertStatus(201);
    }
}

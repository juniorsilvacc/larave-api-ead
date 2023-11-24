<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // \App\Models\Support::factory()->create();
        // \App\Models\Support::factory()->count(5)->create(['user_id' => '', 'lesson_id' => '']);

        return [
            'description' => fake()->sentence(20),
            'status' => 'P',
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
        ];
    }
}

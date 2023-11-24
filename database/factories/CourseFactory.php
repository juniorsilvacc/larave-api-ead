<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // \App\Models\Course::factory()->count(5)->create();
        return [
            'name' => fake()->unique()->name(),
            'description' => fake()->unique()->sentence(20),
        ];
    }
}

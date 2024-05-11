<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'video_id' => fake()->randomDigit(),
            'name' => fake()->name,
            'slug' => Str::slug(fake()->name),
            'description' => fake()->text,
            'thumbnail' => fake()->imageUrl,
            'url' => fake()->url,
            'status' => 'Published',
        ];
    }
}

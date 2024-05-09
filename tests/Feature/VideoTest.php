<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Video;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_a_video_can_be_created(): void
    {
        $response = $this->post('/admin/videos', [
            'video_id' => fake()->numberBetween(1, 100),
        ]);

        $response->assertSuccessful();
    }
}

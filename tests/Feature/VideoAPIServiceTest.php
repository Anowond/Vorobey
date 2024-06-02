<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\VideoAPIService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoAPIServiceTest extends TestCase
{
    use RefreshDatabase;
    public function test_is_data_can_be_recovered_from_API(): void
    {
        // Get the results
        $videoAPIService = new VideoAPIService();
        $results = $videoAPIService();

        // Assert results is not empty
        $this->assertNotEmpty($results);

        // Assert results is an array
        $this->assertIsArray($results);
    }
}

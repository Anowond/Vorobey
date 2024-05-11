<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\VideoAPIService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideosAPIServiceTest extends TestCase
{
    public function testGetDataFromAPI()
    {
        $videoAPIService = new VideoAPIService();
        $result = $videoAPIService->getDataFromAPI();

        // Vérifier que le résultat n'est pas vide
        $this->assertNotEmpty($result);

        // Vérifier que le résultat est un tableau
        $this->assertIsArray($result);

        // Vérifier que les données sont mises en cache
        $cachedVideos = Cache::get('videos');
        $this->assertNotEmpty($cachedVideos);
        $this->assertIsArray($cachedVideos);

    }
}

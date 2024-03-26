<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Services\VideoAPIService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $videoApiService = app(VideoAPIService::class);
        // $videosData = $videoApiService->getDataFromAPI();
        $videosData = Cache::get('videos');
        dd($videosData);
        foreach ($videosData as $video) {

            $name = $video->snippet->title;

            Video::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $video->snippet->description,
                'thumbnail' => $video->snippet->thumbnails->default->url,
                'url' => 'https://www.youtube.com/watch?v=' . $video->id,
                'created_at' => $video->snippet->publishedAt,
                'updated_at' => $video->snippet->publishedAt,
            ]);
        }
    }
}

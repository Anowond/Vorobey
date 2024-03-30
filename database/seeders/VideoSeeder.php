<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Services\VideoAPIService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::all();
        $videoApiService = new VideoAPIService();
        $videosData = $videoApiService->getDataFromAPI();

        foreach ($videosData as $video) {
            $video = $video->items[0];
            $name = $video->snippet->title;

            $newVideo = Video::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $video->snippet->description,
                'thumbnail' => $video->snippet->thumbnails->default->url,
                'url' => 'https://www.youtube.com/watch?v=' . $video->id,
                'created_at' => $video->snippet->publishedAt,
                'updated_at' => $video->snippet->publishedAt,
            ]);

            // Créer des commentaires pour la vidéo
            Comment::factory(rand(1, 5))->create([
                'video_id' => $newVideo->id,
                'user_id' => $user->random(),
            ]);
        }
    }
}

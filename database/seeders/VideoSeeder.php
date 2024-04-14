<?php

namespace Database\Seeders;

use App\Models\Tag;
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
        // Récupération des utilisateurs et des tags
        $users = User::all();
        $tags = Tag::all();
        // Récupération des vidéos en cache
        $videoApiService = new VideoAPIService();
        $videosData = $videoApiService->getDataFromAPI();
        // Récupération des vidéos éxistantes
        $existingVideos = Video::pluck('video_id')->toArray();

        foreach ($videosData as $video) {
            $video = $video->items[0];
            $name = $video->snippet->title;
            $videoID = $video->id;

            // Si la vidéo n'existe pas dans le tableau issu de la base de données, on la créée
            if(!in_array($videoID, $existingVideos)) {
                $newVideo = Video::create([
                    'video_id' => $videoID,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $video->snippet->description,
                    'thumbnail' => $video->snippet->thumbnails->maxres->url,
                    'url' => 'https://www.youtube.com/embed/' . $videoID,
                    'status' => 1,
                    'created_at' => $video->snippet->publishedAt,
                    'updated_at' => $video->snippet->publishedAt,
                ]);

                // Récupérer les tags des descriptions via une RegExp
                preg_match('/^#.*$/m', $newVideo->description, $matches);
                $tags = $matches[0];
                // Traitement des tags, mise en tableau, retrait du signe #, retrait d'un indice en trop
                $tags = explode('#', $matches[0]);
                $tags = array_slice($tags, 1);
                // Traitement et affectation des tags
                foreach ($tags as $tag) {
                    // Création du tag s'il n'existe pas
                    $tag = Tag::firstOrCreate([
                        'name' => $tag,
                        'slug' => Str::slug($tag),
                    ]);
                    // Affectation du tag
                    $newVideo->tags()->attach($tag->id);
                }

                // Créer des commentaires pour la vidéo
                $numberComments = rand(1, 5);
                for ($i = 0; $i < $numberComments; $i++) {
                    Comment::factory()->create([
                        'video_id' => $newVideo->id,
                        'user_id' => $users->random()->id,
                    ]);
                }
            }
        }
    }
}

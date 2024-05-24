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
    public function run(VideoAPIService $service): void
    {
        // Récupération des utilisateurs
        $users = User::all();
<<<<<<< HEAD
        // Récupération des vidéos en cache
        $videoApiService = new VideoAPIService();
        $videosData = $videoApiService->getDataFromAPI();
=======
        // Récupération des vidéos
        $videosData = $service->getDataFromAPI();
>>>>>>> 88cfd73d217a0f5b06ce05a991b9dbd452c3dde8
        // Récupération des vidéos éxistantes
        $existingVideos = Video::pluck('video_id')->toArray();

        foreach ($videosData as $video) {
            $video = $video->items[0];
            $name = $video->snippet->title;
            $videoID = $video->id;
            $thumbnail = $video->snippet->thumbnails;

            // Si la vidéo n'existe pas dans le tableau issu de la base de données, on la créée
            if(!in_array($videoID, $existingVideos)) {
                $newVideo = Video::create([
                    'video_id' => $videoID,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $video->snippet->description,
                    'thumbnail' => $thumbnail->maxres->url ?? $thumbnail->standard->url ??
                    $thumbnail->high->url ?? $thumbnail->medium->url ?? $thumbnail->default->url,
                    'url' => 'https://www.youtube.com/embed/' . $videoID,
                    'status' => 'published',
                    'created_at' => $video->snippet->publishedAt,
                    'updated_at' => $video->snippet->publishedAt,
                ]);

                // Récupérer les tags des descriptions via une RegExp
                // Récherche sur toutes les lignes de la description toutes les lignes commençant par #
                preg_match('/^#.*$/m', $newVideo->description, $matches);
                $tags = $matches[0];

                // Traitement des tags, mise en tableau, retrait du signe #, retrait d'un indice à vide
                $tags = explode('#', $tags);
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

                // Créer entre 1 et 5 commentaires pour la vidéo
                $numberComments = rand(1, 5);
                for ($i = 0; $i < $numberComments; $i++) {
                    Comment::factory()->create([
                        'video_id' => $newVideo->id,
                        'user_id' => $users->random()->id,
                    ])
                }
            }
        }
    }
}

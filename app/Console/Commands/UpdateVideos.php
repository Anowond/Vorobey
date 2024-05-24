<?php

namespace App\Console\Commands;

use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Services\VideoAPIService;

class UpdateVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update videos from API';

    /**
     * Execute the console command.
     */
    public function handle(VideoAPIService $service)
    {
        // Récupération des utilisateurs
        $users = User::all();

        // Récupération des vidéos en cache
        $videosData = $service->getDataFromAPI();

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
                    'status' => 'published',
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
        $this->info('Vidéos have been updated successfully !');
    }
}

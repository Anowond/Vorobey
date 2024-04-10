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
        $user = User::all();
        $tags = Tag::all();
        $videoApiService = new VideoAPIService();
        $videosData = $videoApiService->getDataFromAPI();

        foreach ($videosData as $video) {
            $video = $video->items[0];
            $name = $video->snippet->title;

            $newVideo = Video::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $video->snippet->description,
                'thumbnail' => $video->snippet->thumbnails->maxres->url,
                'url' => 'https://www.youtube.com/embed/' . $video->id,
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
            Comment::factory(rand(1, 5))->create([
                'video_id' => $newVideo->id,
                'user_id' => $user->random(),
            ]);
        }
    }
}

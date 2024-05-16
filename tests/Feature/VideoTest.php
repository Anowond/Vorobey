<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_video_can_be_added_to_the_database(): void
    {
        
        // Envoi dune requête POST a la route /videos
        $response = $this->post('/videos', [
            'video_id' => fake()->randomDigit(),
            'name' => fake()->name,
            'slug' => Str::slug(fake()->name),
            'description' => fake()->text,
            'thumbnail' => fake()->imageUrl,
            'url' => fake()->url,
            'status' => 'Published',
        ]);

        $response->assertRedirect(route('videos'));
    }

    public function test_a_video_can_be_updated_in_the_database(): void
    {
        // Simulation d'un administrateur
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        // Créer un video via une factory
        $video = Video::factory()->create();

        // Données de mise a jour
        $name = fake()->name;
        $slug = Str::slug($name);

        // Envoi d'une requête PATCH pour la mise à jour
        $response = $this->patch(route('admin.video.update', $video), [
            'name' => $name,
            'slug' => $slug,
            'url' => $video->url,
            'description' => $video->description,
            'thumbnail' => $video->thumbnail,
            'status' => $video->status,
        ]);

        // Vérification de la redirection
        $response->assertRedirect(route('admin.video.edit', $slug));

        // Vérrification de la mise à jour de la vidéo
        $this->assertDatabaseHas(Video::class, [
            'name' => $name,
            'slug' => $slug,
        ]);
    }

    public function test_a_video_can_be_deteleted_from_database(): void
    {
        $this->withoutExceptionHandling();

        // Simulation d'un administrateur
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        $this->actingAs($admin);

        // Créer une vidéo via une factory
        $video = Video::factory()->create();

        // Vérifier que la vidéos à bien été créee
        $this->assertDatabaseHas(Video::class, [
            'id' => $video->id,
        ]);

        // Envoi de la requête DELETE
        $response = $this->delete(route('admin.video.destroy', $video));

        // Vérification de la supression du thumbnail
        Storage::assertMissing($video->thumbnail);

        // Vérificationd e la suppression de la video
        $this->assertDatabaseMissing(Video::class, [
            'id' => $video->id,
        ]);

        // Vérification de la redirection en cas de success
        $response->assertRedirect(route('admin.video.index'));
    }
}

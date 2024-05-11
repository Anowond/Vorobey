<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Video;
use Illuminate\View\View;
use App\Enums\videostatus;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.index', ['videos' => Video::without('tags')->latest()->paginate(20)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('admin.edit', [
            'video' => $video,
            'tags' => Tag::orderBy('name')->get(),
            'status' => collect(videostatus::cases())->map(function ($status) {
                return (object) ['id' => $status->value, 'name' => ucfirst($status->name)];
            }),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        // Récupération des données validées depuis la requête personnalisée
        $validated = $request->validated();

        // Traitement du thumbnail
        if (isset($validated['thumbnail'])) {

            // Traitement du thumbnail en cas d'URL
            if (filter_var($validated['thumbnail'], FILTER_VALIDATE_URL)) {
                // Téléchargement et stockage de l'image
                $thumbnail = file_get_contents($validated['thumbnail']);
                // generation d'un nom de fichier unique
                $filename = uniqid() . '.jpg';
                // Stockage de l'image
                $path = '/thumbnails/' . $filename;
                Storage::put($path, $thumbnail);
                // Mise a jour du thumbnail
                $validated['thumbnail'] = $path;
            } else {
                // Mise a jour du thumbnail
                $validated['thumbnail'] = $validated['thumbnail']->store('thumbnails');
            }

            if (isset($video->thumbnail)) {
                // Suppression du thumbnail existant
                Storage::delete($video->thumbnail);
            }

        }

        // Isoler les tags du tableau à passer dans la méthode d'update
        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);

        // Mise à jour la vidéo
        $video->update($validated);

        // Mise à jour des tags avec la méthode sync
        $video->tags()->sync($tags);

        // Redirection vers la page d'édition avec une variable de ssession flash
        return redirect()->route('admin.video.edit', $video)->withStatus('Video updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // Supression du thumbnail associé a la video
        Storage::delete($video->thumbnail);

        // Supression de la video
        $video->delete();

        // Redirection vers la page d'édition avec une variable de session falsh
        return redirect()->route('admin.video.index')->withStatus('Video deleted successfully !');
    }
}

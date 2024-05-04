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
    public function update(VideoRequest $request, Video $video)
    {
        // Récupération des données validées depuis la requête personnalisée
        $validated = $request->validated();

        // Traitement du thumbnail
        if (isset($validated['thumbnail'])) {
            if (isset($video->thumbnail)) {
                // Suppression du thumbnail existant
                Storage::delete($video->thumbnail);
            }
            // Mise a jour du thumbnail
            $validated['thumbnail'] = $validated['thumbnail']->store('thumbnails');
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
    public function destroy(Video $video, Request $request)
    {
        //
    }
}

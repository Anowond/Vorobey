<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class VideoController extends Controller
{
    public function index(): View
    {
        // Récupére toutes les vidéos, par date de création avec une pagination
        $videos = Video::latest()->paginate(12);
        return view('videos.index', ['videos' => $videos]);
    }

    public function show(Video $video): View
    {
        return view('videos.show', ['video' => $video]);
    }

    public function VideosByTag(Tag $tag): View
    {
        return view('videos.index', [
            'videos' => Video::whereRelation(
                'tags',
                'tags.id',
                '=',
                $tag->id,
            )->latest()->paginate(12),
        ]);
    }

    public function comment(Video $video, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'comment' => ['required','string', 'between:2,255'],
        ]);

        Comment::create([
            'content' => $validated['comment'],
            'user_id' => Auth::id(),
            'video_id' => $video->id,
        ]);

        return redirect()->back()->withStatus('Comment added !');
    }

    public function store(Request $request)
    {


        $validated = $request->validate([
            'video_id' => ['required', 'unique:videos'],
            'name' => ['required','string','max:255'],
            'slug' => ['required','string','max:255'],
            'description' => ['required','string'],
            'url' => ['required','url'],
            'thumbnail' => ['required'],
            'status' => ['required', 'in:Published,Unpublished,Archived'],
            'tags' => ['array', 'exists:tags,id'],
        ]);

        $video = Video::create($validated);

        $video->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('videos')->withStatus('Video added successfully !');
    }
}

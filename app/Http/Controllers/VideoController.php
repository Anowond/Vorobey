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
}

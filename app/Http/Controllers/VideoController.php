<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\View\View;

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
}

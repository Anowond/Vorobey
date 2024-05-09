<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SitemapController extends Controller
{

    public function index()
    {
        return response()->view('sitemaps.index')->header('Content-Type', 'text/xml');
    }

    // Récupére les videos dans la base de données et la renvoie a la vue sitemap.videos avec une en-tête XML
    public function videos()
    {
        $videos = Video::latest()->get();
        return response()->view('sitemaps.videos', ['videos' => $videos])->header('Content-Type', 'text/xml');
    }

    public function show(Video $video)
    {
        return response()->view('sitemaps.show', ['video' => $video])->header('Content-Type', 'text/xml');
    }
}

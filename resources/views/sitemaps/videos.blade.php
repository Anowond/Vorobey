{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($videos as $video)
        <url>
            <loc>{{ route('videos.show', ['video' => $video]) }}</loc>
            <lastmod>{{ $video->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>never</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
</urlset>

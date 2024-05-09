{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('videos.show', ['video' => $video]) }}</loc>
        <lastmod>{{ $video->updated_at->toAtomString() }}</lastmod>
        <changefreq>never</changefreq>
        <priority>0.8</priority>
    </url>
</urlset>

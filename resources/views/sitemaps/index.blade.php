{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('index') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>never</changefreq>
        <priority>1</priority>
    </url>
</urlset>

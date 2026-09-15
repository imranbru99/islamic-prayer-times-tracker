<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>2023-02-14T07:41:35+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('pages') }}</loc>
        <lastmod>2023-02-14T07:41:35+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>


    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>2023-02-14T07:41:35+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ route('posts') }}</loc>
        <lastmod>2023-02-14T07:41:35+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($posts as $post)
        <url>
            <loc>{{ route('postView', $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach


    @foreach ($tags as $tag)
        <url>
            <loc>{{ route('tags.show', $tag->slug) }}</loc>
            <lastmod>{{ $tag->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach


    @foreach ($categories as $category)
        <url>
            <loc>{{ route('category.show', $category->slug) }}</loc>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($subCategories as $subCategory)
        <url>
            <loc>{{ route('subCategory.show', $subCategory->slug) }}</loc>
            <lastmod>{{ $subCategory->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($users as $user)
        <url>
            <loc>{{ route('author.show', $user->username) }}</loc>
            <lastmod>{{ $user->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($pages as $page)
        <url>
            <loc>{{ route('pageView', $page->slug) }}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>

@php
    $imagePath = $item->image
        ? asset(ltrim($item->path ?? 'assets/images/post', './') . '/' . $item->image)
        : null;
@endphp
<article class="post-card">
    <a class="post-thumb" href="{{ route('postView', $item->slug) }}">
        @if ($imagePath)
            <img src="{{ $imagePath }}" alt="{{ $item->title }}">
        @endif
    </a>
    <div class="post-meta">
        {{ optional($item->created_at)->format('d M Y') }}
        @if (!empty($item->author))
            · <a href="{{ route('author.show', $item->author->username) }}">{{ $item->author->fullname }}</a>
        @endif
        @isset($item->comments_count)
            · {{ $item->comments_count }} comments
        @endisset
    </div>
    <h3 class="post-title"><a href="{{ route('postView', $item->slug) }}">{{ $item->title }}</a></h3>
    <p>{{ \Illuminate\Support\Str::limit($item->meta, 120) }}</p>
    <a class="btn btn-ghost" href="{{ route('postView', $item->slug) }}">Read more</a>
</article>

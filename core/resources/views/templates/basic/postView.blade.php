@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $imagePath = $post->image
            ? asset(ltrim($post->path ?? 'assets/images/post', './') . '/' . $post->image)
            : null;
    @endphp
    <section class="page-hero">
        <div class="container-premium">
            <p class="kicker">Article</p>
            <h1>{{ $post->title }}</h1>
            <p class="post-meta">
                {{ optional($post->created_at)->format('d M Y') }}
                @if ($post->author)
                    · <a href="{{ route('author.show', $post->author->username) }}">{{ $post->author->fullname }}</a>
                @endif
                · {{ $post->view }} reads
            </p>
            <button class="btn btn-ghost mt-3" type="button" data-bookmark="{{ $post->slug }}">Save article</button>
        </div>
    </section>
    <section class="section" style="padding-top:0">
        <div class="container-premium article-layout">
            <article class="article-body soft-card">
                @if ($imagePath)
                    <div class="post-thumb mb-4"><img src="{{ $imagePath }}" alt="{{ $post->title }}"></div>
                @endif
                <div class="post-entry">{!! $post->content !!}</div>

                @if ($tags && $tags->count())
                    <div class="filter-row mt-4">
                        @foreach ($tags as $tag)
                            <a class="chip" href="{{ route('tags.show', $tag->slug) }}">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                @endif

                <div class="mt-5">
                    <h3>Reflections</h3>
                    @forelse ($comments as $item)
                        <div class="comment-item">
                            <strong>{{ optional($item->user)->fullname ?? 'Member' }}</strong>
                            <p>{{ $item->comment }}</p>
                        </div>
                    @empty
                        <p class="tiny">Be the first to leave a reflection.</p>
                    @endforelse

                    @auth
                        <form class="mt-4" method="post" action="{{ route('comment') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group">
                                <textarea class="form-control" name="comment" rows="4" placeholder="Write a short reflection" required></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Post comment</button>
                        </form>
                    @else
                        <p class="mt-3"><a class="btn btn-ghost" href="{{ route('user.login') }}">Sign in to comment</a></p>
                    @endauth
                </div>
            </article>
            <aside class="sidebar">
                <div class="widget-card">
                    <form method="get" action="{{ route('search') }}">
                        <input class="form-control" type="search" name="q" placeholder="Search articles">
                    </form>
                </div>
                <div class="widget-card">
                    <h5>Topics</h5>
                    @foreach ($categories as $category)
                        <p><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></p>
                    @endforeach
                </div>
                <div class="widget-card">
                    <h5>Latest</h5>
                    @foreach ($latest as $key)
                        <p><a href="{{ route('postView', $key->slug) }}">{{ $key->title }}</a><br><span class="tiny">{{ optional($key->created_at)->format('d M Y') }}</span></p>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>
@endsection

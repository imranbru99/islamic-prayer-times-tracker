@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Page',
        'title' => $page->name,
        'subtitle' => optional($page->created_at)->format('d M Y'),
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium article-layout">
            <article class="article-body soft-card">
                <div class="page-entry">{!! $page->description !!}</div>
            </article>
            <aside class="sidebar">
                <div class="widget-card">
                    <h5>Latest articles</h5>
                    @foreach ($latest as $key)
                        <p><a href="{{ route('postView', $key->slug) }}">{{ $key->title }}</a></p>
                    @endforeach
                </div>
            </aside>
        </div>
    </section>
@endsection

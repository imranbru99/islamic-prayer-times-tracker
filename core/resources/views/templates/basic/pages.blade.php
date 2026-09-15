@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Guides',
        'title' => 'Pages',
        'subtitle' => 'Standing pages from the community library.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="card-grid">
                @forelse ($pages as $item)
                    <article class="post-card">
                        <h3 class="post-title"><a href="{{ route('pageView', $item->slug) }}">{{ $item->name }}</a></h3>
                        <p>{{ $item->meta }}</p>
                        <a class="btn btn-ghost" href="{{ route('pageView', $item->slug) }}">Open page</a>
                    </article>
                @empty
                    <div class="empty-state">No pages have been published yet.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $pages->links() }}</div>
        </div>
    </section>
@endsection

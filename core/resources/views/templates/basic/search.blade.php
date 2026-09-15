@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Library',
        'title' => 'Search',
        'subtitle' => 'Find an article by title or a few words from the text.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <form class="soft-card p-4 mb-4" method="get" action="{{ route('search') }}">
                <div class="subscribe-row">
                    <input class="form-control" type="search" name="q" value="{{ $q }}" placeholder="Search the library">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
            <div class="card-grid">
                @forelse ($posts as $item)
                    @include($activeTemplate . 'partials.post-card', ['item' => $item])
                @empty
                    <div class="empty-state">No articles matched that search.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </section>
@endsection

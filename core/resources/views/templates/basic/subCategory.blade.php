@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Topic',
        'title' => $pageTitle,
        'subtitle' => 'A closer look inside this subcategory.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="card-grid">
                @forelse ($posts as $item)
                    @include($activeTemplate . 'partials.post-card', ['item' => $item])
                @empty
                    <div class="empty-state">No articles in this topic yet.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </section>
@endsection

@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Library',
        'title' => 'Articles',
        'subtitle' => 'Reflections, reminders and notes from the community.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            @isset($categories)
                <div class="filter-row mb-4">
                    @foreach ($categories as $category)
                        <a class="chip" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            @endisset
            <div class="card-grid">
                @forelse ($posts as $item)
                    @include($activeTemplate . 'partials.post-card', ['item' => $item])
                @empty
                    <div class="empty-state">No articles have been published yet.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </section>
@endsection

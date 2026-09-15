@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Author',
        'title' => $authors->fullname,
        'subtitle' => $authors->email,
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            @if ($authors->bio)
                <div class="soft-card p-4 mb-4">{{ $authors->bio }}</div>
            @endif
            <div class="card-grid">
                @forelse ($posts as $item)
                    @include($activeTemplate . 'partials.post-card', ['item' => $item])
                @empty
                    <div class="empty-state">This author has no published articles yet.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </section>
@endsection

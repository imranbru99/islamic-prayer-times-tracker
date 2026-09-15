@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Asmaul Husna',
        'title' => '99 Names of Allah',
        'subtitle' => 'Search by Arabic, transliteration or meaning.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="form-group">
                <input class="form-control" type="search" data-names-search placeholder="Search a name…">
            </div>
            <div class="names-grid">
                @foreach ($names as $index => $name)
                    <article class="name-card" data-name-card>
                        <p class="tiny">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        <p class="arabic">{{ $name['ar'] }}</p>
                        <h3>{{ $name['en'] }}</h3>
                        <p class="tiny">{{ $name['meaning'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

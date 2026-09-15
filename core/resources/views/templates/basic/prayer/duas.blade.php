@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Supplication',
        'title' => 'Daily duas',
        'subtitle' => 'Short, authentic duas for the moments that return every day.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium" data-filter-group>
            <div class="filter-row">
                <button class="chip is-on" type="button" data-filter="all">All</button>
                @foreach (collect($duas)->pluck('category')->unique() as $category)
                    <button class="chip" type="button" data-filter="{{ $category }}">{{ $category }}</button>
                @endforeach
            </div>
            <div class="card-grid">
                @foreach ($duas as $dua)
                    <article class="dua-card" data-filter-item data-cat="{{ $dua['category'] }}">
                        <p class="kicker">{{ $dua['category'] }}</p>
                        <h3>{{ $dua['title'] }}</h3>
                        <p class="arabic">{{ $dua['ar'] }}</p>
                        <p>{{ $dua['en'] }}</p>
                        <p class="tiny">{{ $dua['ref'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection

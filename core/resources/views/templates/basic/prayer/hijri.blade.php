@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Calendar',
        'title' => 'Hijri calendar',
        'subtitle' => 'This Gregorian month, with each Islamic day beside it.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="month-grid" data-hijri-cal></div>
        </div>
    </section>
@endsection

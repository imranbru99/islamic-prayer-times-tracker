@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Direction',
        'title' => 'Qibla compass',
        'subtitle' => 'Allow location access and the needle will point toward the Kaaba from where you are.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium text-center">
            <div class="qibla-compass">
                <div class="qibla-needle" data-qibla-needle></div>
            </div>
            <p class="lead" data-qibla-deg>Waiting for location…</p>
            <a class="btn btn-ghost" href="{{ route('prayer.times') }}">See prayer times</a>
        </div>
    </section>
@endsection

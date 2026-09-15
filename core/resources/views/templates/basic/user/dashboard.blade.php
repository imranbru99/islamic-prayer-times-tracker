@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Assalamu alaikum',
        'title' => $user->firstname,
        'subtitle' => 'A quiet view of today’s salah and your writing.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="stat-grid mb-4">
                <div class="stat-card">
                    <p class="tiny">Today’s prayers</p>
                    <h2>{{ $stats['today_count'] }} / 5</h2>
                </div>
                <div class="stat-card">
                    <p class="tiny">Month consistency</p>
                    <h2>{{ $stats['month_percent'] }}%</h2>
                </div>
                <div class="stat-card">
                    <p class="tiny">Complete days</p>
                    <h2>{{ $stats['month_complete'] }}</h2>
                </div>
                <div class="stat-card">
                    <p class="tiny">Your articles</p>
                    <h2>{{ $stats['total_posts'] }}</h2>
                </div>
            </div>

            @php
                $prayers = ['fajr' => 'Fajr', 'dhuhr' => 'Dhuhr', 'asr' => 'Asr', 'maghrib' => 'Maghrib', 'isha' => 'Isha'];
            @endphp
            <div class="tracker-prayers mb-4">
                @foreach ($prayers as $key => $label)
                    <button type="button"
                        class="prayer-toggle {{ !empty($today) && $today->{$key} ? 'is-on' : '' }}"
                        data-prayer-toggle
                        data-prayer="{{ $key }}"
                        data-url="{{ route('user.attendance.toggle') }}"
                        data-token="{{ csrf_token() }}"
                        data-login="{{ route('user.login') }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="feature-grid">
                <a class="feature-card" href="{{ route('prayer.tracker') }}">
                    <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
                    <h3>Full tracker</h3>
                    <p>Open the month view, notes, Tahajjud and Witr.</p>
                </a>
                <a class="feature-card" href="{{ route('user.post.index') }}">
                    <div class="feature-icon"><i class="fa-solid fa-pen"></i></div>
                    <h3>Your articles</h3>
                    <p>Review everything you have written.</p>
                </a>
                <a class="feature-card" href="{{ route('user.post.create') }}">
                    <div class="feature-icon"><i class="fa-solid fa-plus"></i></div>
                    <h3>Write</h3>
                    <p>Start a new post for the library.</p>
                </a>
                <a class="feature-card" href="{{ route('user.profile') }}">
                    <div class="feature-icon"><i class="fa-solid fa-user"></i></div>
                    <h3>Profile</h3>
                    <p>Update your name, photo and address.</p>
                </a>
            </div>
        </div>
    </section>
@endsection

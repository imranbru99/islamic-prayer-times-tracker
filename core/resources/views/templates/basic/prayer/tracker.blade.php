@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Consistency',
        'title' => 'Prayer tracker',
        'subtitle' => 'Mark the five daily prayers. Optional Tahajjud and Witr sit beside them.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="stat-grid mb-4">
                <div class="stat-card">
                    <p class="tiny">Today</p>
                    <h2 data-today-count>{{ $stats['today_count'] }} / 5</h2>
                </div>
                <div class="stat-card">
                    <p class="tiny">Streak</p>
                    <h2 data-streak>{{ $stats['streak'] }}</h2>
                </div>
                <div class="stat-card">
                    <p class="tiny">This month</p>
                    <h2 data-month-percent>{{ $stats['month_percent'] }}%</h2>
                </div>
                <div class="stat-card">
                    <p class="tiny">Complete days</p>
                    <h2>{{ $stats['month_complete'] }}</h2>
                </div>
            </div>

            @guest
                <div class="soft-card p-4 mb-4">
                    <p>Sign in to save your salah across devices and keep a real streak.</p>
                    <a class="btn btn-primary" href="{{ route('user.login') }}">Sign in to track</a>
                </div>
            @endguest

            @auth
                @php
                    $prayers = [
                        'fajr' => 'Fajr',
                        'dhuhr' => 'Dhuhr',
                        'asr' => 'Asr',
                        'maghrib' => 'Maghrib',
                        'isha' => 'Isha',
                    ];
                    $extra = [
                        'tahajjud' => 'Tahajjud',
                        'witr' => 'Witr',
                    ];
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
                <div class="tracker-prayers mb-4" style="grid-template-columns:repeat(2,1fr)">
                    @foreach ($extra as $key => $label)
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

                <form method="post" action="{{ route('user.attendance.store') }}" class="soft-card p-4 mb-4">
                    @csrf
                    <div class="form-group">
                        <label>Note for today</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="A private note, optional">{{ optional($today)->notes }}</textarea>
                    </div>
                    <button class="btn btn-ghost" type="submit">Save note</button>
                </form>

                <h3 class="mb-3">This month</h3>
                <div class="month-grid">
                    @for ($day = 1; $day <= now()->daysInMonth; $day++)
                        @php
                            $date = now()->copy()->startOfMonth()->addDays($day - 1)->toDateString();
                            $row = $monthRecords->get($date);
                            $classes = 'month-day';
                            if ($row && $row->isComplete()) $classes .= ' is-complete';
                            if ($date === now()->toDateString()) $classes .= ' is-today';
                        @endphp
                        <div class="{{ $classes }}">
                            <strong>{{ $day }}</strong>
                            <div class="tiny">{{ $row ? $row->obligatoryCount() . '/5' : '—' }}</div>
                        </div>
                    @endfor
                </div>
            @endauth
        </div>
    </section>
@endsection

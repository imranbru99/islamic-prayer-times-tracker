@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="hero">
        <div class="container-premium hero-grid">
            <div>
                <p class="kicker">Salah · Dhikr · Knowledge</p>
                <h1>A calmer home for daily prayer.</h1>
                <p class="lead">Know the next salah, keep a gentle streak, and gather beneficial reminders in one refined place.</p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="{{ route('prayer.times') }}">Today's prayer times</a>
                    <a class="btn btn-ghost" href="{{ route('prayer.tracker') }}">Open tracker</a>
                </div>
                <div class="hero-meta">
                    <span><i class="fa-solid fa-location-dot"></i> Location aware times</span>
                    <span><i class="fa-solid fa-moon"></i> Hijri date included</span>
                </div>
            </div>
            <aside class="prayer-panel" data-prayer-panel>
                <div class="prayer-panel-top">
                    <div>
                        <p class="kicker">Next prayer</p>
                        <h2 class="next-prayer" data-next-prayer>Loading</h2>
                        <div class="countdown" data-countdown>Finding your city…</div>
                    </div>
                    <div class="tiny text-end">
                        <div data-prayer-location>Local timezone</div>
                        <div data-prayer-hijri></div>
                    </div>
                </div>
                <div class="prayer-list" data-prayer-list></div>
            </aside>
        </div>
    </section>

    <section class="section">
        <div class="container-premium">
            <div class="section-head">
                <div>
                    <p class="kicker">Worship tools</p>
                    <h2>Everything you reach for after the adhan.</h2>
                </div>
            </div>
            <div class="feature-grid">
                <a class="feature-card" href="{{ route('prayer.times') }}">
                    <div class="feature-icon"><i class="fa-regular fa-clock"></i></div>
                    <h3>Prayer times</h3>
                    <p>Accurate salah times with a live countdown to the next prayer.</p>
                </a>
                <a class="feature-card" href="{{ route('prayer.qibla') }}">
                    <div class="feature-icon"><i class="fa-solid fa-compass"></i></div>
                    <h3>Qibla</h3>
                    <p>Find the direction of the Kaaba from wherever you are standing.</p>
                </a>
                <a class="feature-card" href="{{ route('prayer.tasbih') }}">
                    <div class="feature-icon"><i class="fa-solid fa-circle-notch"></i></div>
                    <h3>Tasbih</h3>
                    <p>A quiet digital counter for tasbih, tahmid, takbir and istighfar.</p>
                </a>
                <a class="feature-card" href="{{ route('prayer.tracker') }}">
                    <div class="feature-icon"><i class="fa-solid fa-check"></i></div>
                    <h3>Tracker</h3>
                    <p>Mark Fajr to Isha, keep a streak, and see the month at a glance.</p>
                </a>
                <a class="feature-card" href="{{ route('prayer.duas') }}">
                    <div class="feature-icon"><i class="fa-solid fa-book-open"></i></div>
                    <h3>Daily duas</h3>
                    <p>Morning, travel, sleep and protection — short duas you can memorise.</p>
                </a>
                <a class="feature-card" href="{{ route('prayer.names') }}">
                    <div class="feature-icon"><i class="fa-solid fa-star-and-crescent"></i></div>
                    <h3>99 Names</h3>
                    <p>The beautiful names of Allah with English meanings, ready to search.</p>
                </a>
                <a class="feature-card" href="{{ route('prayer.hijri') }}">
                    <div class="feature-icon"><i class="fa-regular fa-calendar"></i></div>
                    <h3>Hijri calendar</h3>
                    <p>See this Gregorian month mapped to the Islamic date.</p>
                </a>
                <a class="feature-card" href="{{ route('posts') }}">
                    <div class="feature-icon"><i class="fa-solid fa-feather"></i></div>
                    <h3>Articles</h3>
                    <p>Reflections, fiqh notes and community writing from the library.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="soft-card ayah-card" data-ayah>
                <p class="kicker">Verse of the visit</p>
                <p class="lead">A verse is being prepared for you…</p>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="section-head">
                <div>
                    <p class="kicker">Library</p>
                    <h2>Latest articles</h2>
                </div>
                <a class="btn btn-ghost" href="{{ route('posts') }}">View all</a>
            </div>
            <div class="card-grid">
                @forelse ($posts as $item)
                    @include($activeTemplate . 'partials.post-card', ['item' => $item])
                @empty
                    <div class="empty-state">Articles will appear here once they are published.</div>
                @endforelse
            </div>
            @if (!empty($popular) && $popular->count())
                <div class="section-head mt-5">
                    <div>
                        <p class="kicker">Most read</p>
                        <h2>Popular articles</h2>
                    </div>
                </div>
                <div class="card-grid">
                    @foreach ($popular as $item)
                        @include($activeTemplate . 'partials.post-card', ['item' => $item])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection

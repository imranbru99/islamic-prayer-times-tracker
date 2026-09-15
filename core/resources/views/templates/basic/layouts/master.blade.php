<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $general->sitename(@$page_title ?? $pageTitle) }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset(imagePath()['logoIcon']['path'] . '/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/templates/basic/css/premium.css') }}">
    @stack('style-lib')
    @stack('style')
</head>
<body class="premium-body">
    @php echo fbcomment() @endphp
    <div class="site-wrap">
        <header class="site-header">
            <div class="container-premium header-bar">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark"><i class="fa-solid fa-moon"></i></span>
                    {{ $general->sitename }}
                </a>
                <button class="nav-toggle" type="button" data-nav-toggle aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <nav class="nav-links" data-nav-links>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
                    <a href="{{ route('prayer.times') }}" class="{{ request()->routeIs('prayer.times') ? 'is-active' : '' }}">Prayer Times</a>
                    <a href="{{ route('prayer.tracker') }}" class="{{ request()->routeIs('prayer.tracker') ? 'is-active' : '' }}">Tracker</a>
                    <div class="nav-dropdown">
                        <span>Worship</span>
                        <div class="nav-dropdown-menu">
                            <a href="{{ route('prayer.qibla') }}">Qibla Compass</a>
                            <a href="{{ route('prayer.tasbih') }}">Digital Tasbih</a>
                            <a href="{{ route('prayer.duas') }}">Daily Duas</a>
                            <a href="{{ route('prayer.names') }}">99 Names</a>
                            <a href="{{ route('prayer.hijri') }}">Hijri Calendar</a>
                        </div>
                    </div>
                    <a href="{{ route('posts') }}" class="{{ request()->routeIs('posts') || request()->routeIs('blog') ? 'is-active' : '' }}">Articles</a>
                    <a href="{{ route('pages') }}" class="{{ request()->routeIs('pages') ? 'is-active' : '' }}">Pages</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">Contact</a>
                    @auth
                        <a href="{{ route('user.home') }}">Dashboard</a>
                    @endauth
                </nav>
                <div class="header-actions">
                    <a class="icon-btn" href="{{ route('search') }}" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <button class="icon-btn" type="button" data-theme-toggle aria-label="Toggle theme"><i class="fa-solid fa-circle-half-stroke"></i></button>
                    @guest
                        <a class="btn btn-ghost" href="{{ route('user.login') }}">Sign in</a>
                        <a class="btn btn-primary" href="{{ route('user.register') }}">Join</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('user.home') }}">{{ auth()->user()->firstname }}</a>
                    @endguest
                </div>
            </div>
        </header>

        <main class="site-main">
            @yield('content')
        </main>

        <footer class="site-footer">
            <div class="container-premium">
                <div class="footer-grid">
                    <div>
                        <div class="brand">{{ $general->sitename }}</div>
                        <p class="mt-3">A quieter place for salah, remembrance, and beneficial knowledge. Track the five prayers, learn a dua, and return tomorrow a little more consistent.</p>
                    </div>
                    <div>
                        <h5>Explore</h5>
                        <p><a href="{{ route('prayer.times') }}">Prayer times</a></p>
                        <p><a href="{{ route('prayer.tracker') }}">Prayer tracker</a></p>
                        <p><a href="{{ route('prayer.duas') }}">Daily duas</a></p>
                        <p><a href="{{ route('posts') }}">Articles</a></p>
                    </div>
                    <div>
                        <h5>Weekly reminder</h5>
                        <p>Receive a short note for Jumuah and a verse for the week.</p>
                        <form class="subscribe-row" method="post" action="{{ route('subscribe') }}">
                            @csrf
                            <input class="form-control" type="email" name="email" placeholder="Your email" required>
                            <button class="btn btn-gold" type="submit">Join</button>
                        </form>
                    </div>
                </div>
                <div class="footer-copy">
                    Copyright &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $general->sitename }}</a>. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/templates/basic/js/premium.js') }}"></script>
    <script src="{{ asset('assets/admin/ckeditor5/ckeditor.js') }}"></script>
    <script>
        if (document.querySelector('#editor') && window.ClassicEditor) {
            ClassicEditor.create(document.querySelector('#editor')).catch(function () {});
        }
    </script>
    @include('admin.partials.notify')
    @include('partials.plugins')
    @stack('script-lib')
    @stack('script')
</body>
</html>

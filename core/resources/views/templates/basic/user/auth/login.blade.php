@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="auth-shell">
        <div class="auth-card">
            <p class="kicker">Welcome back</p>
            <h1 class="mb-2">{{ $general->sitename }}</h1>
            <p class="lead">Sign in to keep your prayer streak and writing.</p>
            <form class="mt-4" method="post" action="{{ route('user.login') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username or email</label>
                    <input name="username" type="text" class="form-control" id="username" value="{{ old('username') }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign in</button>
                <p class="mt-3 tiny"><a href="{{ route('user.password.request') }}">Forgot password?</a></p>
                <p class="mt-2">New here? <a href="{{ route('user.register') }}">Create an account</a></p>
            </form>
        </div>
    </section>
@endsection

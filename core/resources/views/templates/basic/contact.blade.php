@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Support',
        'title' => 'Contact',
        'subtitle' => 'Write to us and we will open a support ticket for you.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="soft-card p-4">
                        <h3>Reach the team</h3>
                        <p>Email: {{ $general->email }}</p>
                        <p class="tiny">For any inquiry, we will reply through your ticket so the conversation stays in one place.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form class="soft-card p-4" method="post" action="{{ route('contact.send') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input class="form-control" type="text" name="subject" value="{{ old('subject') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Send message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

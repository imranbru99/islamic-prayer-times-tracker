@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Salah',
        'title' => 'Prayer times',
        'subtitle' => 'We use your location when you allow it. Otherwise choose a city and we will load today’s timetable.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="prayer-panel" data-prayer-panel>
                        <div class="prayer-panel-top">
                            <div>
                                <p class="kicker">Next prayer</p>
                                <h2 class="next-prayer" data-next-prayer>Loading</h2>
                                <div class="countdown" data-countdown></div>
                            </div>
                            <div class="tiny text-end">
                                <div data-prayer-location></div>
                                <div data-prayer-hijri></div>
                            </div>
                        </div>
                        <div class="prayer-list" data-prayer-list></div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="soft-card p-4">
                        <h3 class="card-title">Choose a city</h3>
                        <p class="tiny mb-3">Times follow the Muslim World League calculation method.</p>
                        <form data-city-form>
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" type="text" name="city" placeholder="Dhaka">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input class="form-control" type="text" name="country" placeholder="Bangladesh">
                            </div>
                            <button class="btn btn-primary" type="submit">Update times</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

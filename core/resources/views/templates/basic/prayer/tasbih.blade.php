@extends($activeTemplate . 'layouts.master')
@section('content')
    @include($activeTemplate . 'partials.page-hero', [
        'kicker' => 'Dhikr',
        'title' => 'Digital tasbih',
        'subtitle' => 'Tap the ring. Your count stays on this device until you reset it.',
    ])
    <section class="section" style="padding-top:0">
        <div class="container-premium tasbih-wrap" data-tasbih>
            <div class="text-center">
                <div class="tasbih-ring" data-tasbih-ring>
                    <div>
                        <div class="tasbih-count" data-tasbih-count>0</div>
                        <div class="tiny">tap to count</div>
                    </div>
                </div>
                <div class="inline-actions justify-content-center">
                    <button class="btn btn-ghost" type="button" data-tasbih-reset>Reset</button>
                    <label class="tiny">Target
                        <select class="form-select d-inline-block w-auto" name="target">
                            <option value="33">33</option>
                            <option value="99">99</option>
                            <option value="100">100</option>
                            <option value="0">Free</option>
                        </select>
                    </label>
                </div>
            </div>
            <div>
                <div class="filter-row">
                    @foreach ($phrases as $index => $phrase)
                        <button class="chip {{ $index === 0 ? 'is-on' : '' }}" type="button" data-phrase>
                            {{ $phrase['en'] }}
                        </button>
                    @endforeach
                </div>
                <div class="card-grid" style="grid-template-columns:1fr">
                    @foreach ($phrases as $phrase)
                        <div class="soft-card p-4">
                            <p class="arabic">{{ $phrase['ar'] }}</p>
                            <h3>{{ $phrase['en'] }}</h3>
                            <p class="tiny">{{ $phrase['meaning'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

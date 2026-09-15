<section class="page-hero">
    <div class="container-premium">
        <p class="kicker">{{ $kicker ?? $general->sitename }}</p>
        <h1>{{ $title ?? $pageTitle ?? $page_title }}</h1>
        @if (!empty($subtitle))
            <p class="lead">{{ $subtitle }}</p>
        @endif
    </div>
</section>

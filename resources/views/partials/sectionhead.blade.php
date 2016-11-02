<section class="content-header">
    <h2>
        {{ $page_title }}
    </h2>
    @if (Session::has('flash_alert_notice'))
    <div class="alert {{ Session::get('alert_class','alert-success') }}">{{ Session::get('flash_alert_notice') }}</div>
    @endif
</section>

@if($bodyBanner)
<div class="advertisement">
    <a href="{{ $bodyBanner->url }}">
        <img src="{{ $bodyBanner->getImage('main')->getLargest() }}" class="img-responsive" />
    </a>
</div>
@else
<div class="advertisement">
    <a href="{{ URL::page('banner/request') }}?size=618x93">
        <img src="{{ URL::asset('app/img/{lan}/banner618x93.jpg') }}" class="img-responsive" />
    </a>
</div>
@endif
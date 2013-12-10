@foreach($sideBanners as $sideBanner)
<div class="advertisement">
    <a href="{{ $sideBanner->url }}">
        <img src="{{ $sideBanner->getImage('main')->getLargest() }}" class="img-responsive" />
    </a>
</div>
@endforeach
@if($sideBanners->count() < $maximumSideBanners)
<div class="advertisement" style="margin-top:10px;">
    <a href="{{ URL::page('banner/request') }}?size=303x252">
        <img src="{{ URL::asset('app/img/{lan}/banner303x252.jpg') }}" class="img-responsive" />
    </a>
</div>
@endif
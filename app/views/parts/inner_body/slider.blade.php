
@if(! $sliders->isEmpty())
<div class="main-title">
    <a href="#">{{ trans('titles.latest_news') }}</a>
</div>

<div id="slider" dir="ltr">
    <ul id="newsslider">
        @foreach($sliders as $slider)
        <li>
            @if($image = $slider->getImage('main'))
            <a href="{{ URL::page('slider/show', $slider) }}"><img src="{{ $image->getNearest(596, 210) }}" width="82" height="30" alt="{{ $slider->title }}" /></a>
            @endif
            <h3><a href="{{ URL::page('slider/show', $slider) }}">{{ $slider->title }}</a></h3>
            {{ $slider->small_description }}<br />
        </li>
        @endforeach
    </ul>
</div>

@endif
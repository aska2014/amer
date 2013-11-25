
@if(! $sliders->isEmpty())
<div class="main-title">
    <a href="#">آخر الأخبار</a>
</div>

<div id="slider">
    <ul id="newsslider" dir="ltr">
        @foreach($sliders as $slider)
        <li>
            @if($image = $slider->getImage('main'))
            <a href="{{ URL::page('one-slider', $slider) }}"><img src="{{ $image->getNearest(596, 210) }}" width="82" height="30" alt="{{ $slider->title }}" /></a>
            @endif
            <h3><a href="{{ URL::page('one-slider', $slider) }}">{{ $slider->title }}</a></h3>
            {{ $slider->small_description }}<br />
        </li>
        @endforeach
    </ul>
</div>

<div class="clearfix"></div>

@if($slider = $sliders->first())
<div class="latest-news-sm">

    <div class="img-div">
        @if($image = $slider->getImage('main'))
        <a href="#"><img class="img-responsive" src="{{ $image->getNearest(596,210) }}" width="82" height="30" alt="{{ $slider->title }}" /></a>
        @endif
    </div>

    <div class="info-div">
        <h3><a href="{{ URL::page('one-slider', $slider) }}">{{ $slider->title }}</a></h3>
        <p>{{ $slider->small_description }}
            <br /><a href="{{ URL::page('one-slider', $slider) }}"> &raquo; أقرأ المزيد ...</a></p>
    </div>

</div>
@endif

@endif
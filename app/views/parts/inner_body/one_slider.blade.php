<div class="main-title">
    <h1><a href="#">{{ trans('titles.one_news') }}</a></h1>
</div>

<div class="one-news">

    <h2><a href="#">{{ $slider->title }}</a></h2>

    <span class="date">
        {{ $date->date('l, d F Y - H:m', $slider->created_at) }}
    </span>

    @if($image = $slider->getImage('main'))
    <img class="img-responsive" src="{{ $image->getLargest() }}" alt=""/>
    @endif

    <p>
        {{ $slider->large_description }}
    </p>

</div>
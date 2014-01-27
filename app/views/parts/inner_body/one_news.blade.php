<div class="main-title">
    <h1><a href="#">{{ trans('titles.one_news') }}</a></h1>
</div>

<div class="one-news">

    <h2><a href="#">{{ $oneNews->title }}</a></h2>

    <span class="date">
        {{ $date->date('l, d F Y - H:m', $oneNews->created_at) }}
    </span>

    @if($image = $oneNews->getImage('main'))
    <img class="img-responsive" src="{{ $image->getNearest(450, 268) }}" alt=""/>
    @endif

    <p>
        {{ $oneNews->description }}
    </p>

</div>
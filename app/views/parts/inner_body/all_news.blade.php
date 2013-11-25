<div class="main-title">
    <a href="#">أخر الأخبار</a>
</div>


<div class="four-box-divider">

    @foreach($news as $oneNews)

    <div class="box">
        <div class="inner-box">
            @if($image = $oneNews->getImage('main'))
            <a href="{{ URL::page('one-news', $oneNews) }}"><img class="img-resposive" src="{{ $image->getNearest(143, 105) }}" alt="{{ $oneNews->title }}"/></a>
            @endif
            <span class="date">{{ $date->date('d F Y', $oneNews->created_at) }}</span>
            <h2>
                <a href="{{ URL::page('one-news', $oneNews) }}">{{ $oneNews->title }}</a>
            </h2>
        </div>
    </div>

    @endforeach

</div>
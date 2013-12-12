<div class="latest-news">

    <img src="{{ URL::asset('app/img/{lan}/latest-news.png') }}" alt=""/>

    <div class="latest-news-text">
        <a href="{{ URL::page('news/show', $latestNews) }}"><marquee direction="left">{{ $latestNews->title }}</marquee></a>
    </div>

</div>
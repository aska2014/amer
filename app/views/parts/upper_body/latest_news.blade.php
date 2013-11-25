<div class="latest-news">

    <img src="{{ URL::asset('app/img/latest-news.png') }}" alt=""/>

    <div class="latest-news-text">
        <a href="{{ URL::page('one-news', $latestNews) }}"><marquee>{{ $latestNews->title }}</marquee></a>
    </div>

</div>
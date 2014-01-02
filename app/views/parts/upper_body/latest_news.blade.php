<div class="latest-news">

    <img src="{{ URL::asset('app/img/{lan}/latest-news.png') }}" alt=""/>

    <div class="latest-news-text">
        <ul id="news-marquee" class="marquee" dir="rtl">
            @foreach($latestNews as $latestOneNews)
            <li onclick="window.location.href = '{{ URL::page('news/show', $latestOneNews) }}'">
                {{ $latestOneNews->title }}
            </li>
            @endforeach
        </ul>
    </div>

</div>
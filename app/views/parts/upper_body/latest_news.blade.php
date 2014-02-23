<div class="latest-news">

    <img src="{{ URL::asset('app/img/{lan}/latest-news.png') }}" alt=""/>

    <div class="latest-news-text">
        <ul id="news-marquee" class="marquee" dir="rtl">
            <li>
                @foreach($latestNews as $latestOneNews)
                    <a href="'{{ URL::page('news/show', $latestOneNews) }}'">{{ $latestOneNews->title }}</a>
                    &nbsp&nbsp&nbsp
                    --------------
                    &nbsp&nbsp&nbsp
                @endforeach
            </li>
        </ul>
    </div>

</div>
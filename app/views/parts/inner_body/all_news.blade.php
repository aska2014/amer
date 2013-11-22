<div class="main-title">
    <a href="#">أخر الأخبار</a>
</div>


<div class="four-box-divider">

    @foreach($news as $oneNews)

    <div class="box">
        <div class="inner-box">
            @if($image = $oneNews->getImage('main'))
            <img class="img-resposive" src="{{ $image->getLargest()->url }}" alt=""/>
            @endif
            <span class="date">22 نوفمبر, 2013</span>
            <h2>
                <a href="{{ URL::page('one-news', $oneNews) }}">{{ $oneNews->title }}</a>
            </h2>
        </div>
    </div>


    @endforeach

</div>
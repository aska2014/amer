<div class="main-title">
    <a href="#">{{ $oneNews->title }}</a>
</div>

<div class="one-news">

    <h2><a href="#">{{ $oneNews->title }}</a></h2>

    <span class="date">السبت، 19 أكتوبر 2013 - 08:26</span>

    @if($image = $oneNews->getImage('main'))
    <img class="img-responsive" src="{{ $image->getLargest()->url }}" alt=""/>
    @endif

    <p>
        {{ $oneNews->description }}
    </p>

</div>
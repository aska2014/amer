<div class="main-title">
    <a href="#">عروض مميزة</a>
</div>


<div class="body-specials">
    @foreach($specials as $special)
    <div class="special">
        <div class="img-div">
            @if($image = $special->getImage('main'))
            <a href="{{ URL::page('one-estate', $special) }}"><img class="img-responsive img-circle" src="{{ $image->getNearest(145, 145) }}" alt="{{ $special->title }}"/></a>
            @endif
        </div>
        <div class="info-div">

            <div class="description">
                <a href="{{ URL::page('one-estate', $special) }}">{{ $special->title }}</a>
            </div>

            <div class="city">
                المدينة:-
                {{ $special->city }}
            </div>

            <div class="price">
                السعر:-
                {{ $special->price->format() }}
            </div>
        </div>
    </div>
    @endforeach
</div>
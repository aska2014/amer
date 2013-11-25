<div class="main-title">
    <a href="#">عروض مميزة</a>
</div>


<div class="body-specials">
    @foreach($specials as $special)
    <div class="special">
        <div class="img-div">
            @if($image = $special->getImage('main'))
            <img class="img-responsive img-circle" src="{{ $image->getNearest(145, 145) }}" alt="{{ $special->title }}"/>
            @endif
        </div>
        <div class="info-div">

            <div class="description">
                {{ $special->title }}
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
<div class="main-title">
    <a href="#">{{ trans('titles.special_offers') }}</a>
</div>


<div class="body-specials">
    @foreach($specials as $special)
    <div class="special">
        <div class="img-div">
            @if($image = $special->getImage('main'))
            <a href="{{ URL::page('estate/show', $special) }}"><img class="img-responsive img-circle" src="{{ $image->getNearest(145, 145) }}" alt="{{ $special->title }}"/></a>
            @endif
        </div>
        <div class="info-div">

            <div class="description">
                <a href="{{ URL::page('estate/show', $special) }}">{{ $special->title }}</a>
            </div>

            <div class="city">
                {{ trans('estate.titles.city') }}
                {{ $special->city }}
            </div>

            <div class="price">
                {{ trans('estate.titles.price') }}
                {{ $special->price->format() }}
            </div>
        </div>
    </div>
    @endforeach
</div>
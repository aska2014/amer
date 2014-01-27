<div class="main-title">
    <h1><a href="{{ URL::page('estate/special-offers') }}">{{ trans('titles.special_offers') }}</a></h1>
</div>

<div class="clearfix"></div>

<ul id="carousel" class="elastislide-list special-slider" dir="ltr">
    @foreach($specials as $special)
    @if($image = $special->getImage('main'))
    <li>
        <a href="{{ URL::page('estate/show', $special) }}">
            <img class="img-circle img-responsive" src="{{ $image->getNearest(145, 145) }}" width="145" height="145" alt="{{ $special->title }}"/>
        </a>
        <div class="info-div">

            <div class="description">
                <a href="{{ URL::page('estate/show', $special) }}">{{ Str::limit($special->title, 25, '') }}</a>
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

        <div class="clearfix"></div>
    </li>
    @endif
    @endforeach
</ul>
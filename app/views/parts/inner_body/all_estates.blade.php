<div class="main-title">
    <a href="#">{{ $estatesTitle }}</a>
</div>

<div class="all-estates">

    @foreach($estates as $estate)
    <div class="estate">
        <div class="img-div">
            @if($image = $estate->getImage('main'))
            <img class="img-responsive" src="{{ $image->getNearest(200, 150) }}" alt="{{ $estate->title }}"/>
            @endif
        </div>

        <div class="info-div">
            <h2><a href="{{ URL::page('one-estate', $estate) }}">{{ $estate->title }}</a></h2>

            <p>{{ Str::limit($estate->description, 80) }}</p>

            <div>
                <span>التعليقات(0)</span>
                <span>عدد المشاهدات(0)</span>
            </div>
        </div>

        <div class="extra-info-div">
            <span class="price">{{ $estate->price->format() }}</span>
            <span class="date">
                {{ $date->since($estate->created_at) }}
            </span>
        </div>
    </div>

    <div class="separator"></div>
    @endforeach

</div>
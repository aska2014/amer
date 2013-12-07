<div class="main-title">
    <a href="#">{{ $estatesTitle }}</a>
</div>

<div class="all-estates">

    @foreach($estates as $estate)
    <div class="estate {{ $estate->isSpecial() ? 'estate-special' : '' }}">
        <div class="img-div">
            @if($image = $estate->getImage('main'))
            <img class="img-responsive" src="{{ $image->getNearest(200, 150) }}" alt="{{ $estate->title }}"/>
            @endif
        </div>

        <div class="info-div">
            <h2><a href="{{ URL::page('estate/show', $estate) }}">{{ $estate->title }}</a></h2>

            <p>{{ Str::limit($estate->description, 80) }}</p>

            <div>
                <span>التعليقات({{ $estate->getNumberOfComments() }})</span>
                <span>عدد المشاهدات(0)</span>
            </div>
        </div>

        <div class="extra-info-div">
            @if($authUser and $authUser->same($estate->user))

            <div class="user-tools">
                <a href="{{ URL::page('estate/edit', $estate) }}">تعديل العقار</a>
                <a href="{{ URL::page('estate/upgrade', $estate) }}">تمييز العقار</a>
                <a href="{{ URL::page('estate/remove', $estate) }}">مسح العقار</a>
            </div>

            @else

            <span class="price">{{ $estate->price->format() }}</span>
            <span class="date">
                {{ $date->since($estate->created_at) }}
            </span>

            @endif
        </div>
    </div>

    <div class="separator"></div>
    @endforeach

    {{ $estates->appends($getArrayWithoutPage)->links() }}

</div>
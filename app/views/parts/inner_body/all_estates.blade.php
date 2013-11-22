<div class="main-title">
    <a href="#">{{ $category->title }}</a>
</div>

<div class="all-estates">

    @foreach($category->estates as $estate)
    <div class="estate">
        <div class="img-div">
            @if($image = $estate->getImage('main'))
            <img class="img-responsive" src="{{ $image->getLargest()->url }}" alt=""/>
            @endif
        </div>

        <div class="info-div">
            <h2><a href="#">{{ $estate->title }}</a></h2>

            <p>{{ Str::limit($estate->description, 80) }}</p>

            <div>
                <span>التعليقات(0)</span>
                <span>عدد المشاهدات(0)</span>
            </div>
        </div>

        <div class="extra-info-div">
            <span class="price">{{ $estate->price }} جنيه</span>
            <span class="date">نشر قبل 2 دقيقه</span>
        </div>
    </div>

    <div class="separator"></div>
    @endforeach

</div>
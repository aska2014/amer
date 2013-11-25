<div class="main-title">
    <a href="#">{{ $estate->title }}</a>
</div>


<div class="one-estate">

    <div class="img-div">
        @if($image = $estate->getImage('main'))
        <img class="img-responsive" src="{{ $image->getNearest(200, 150)->url }}" alt=""/>
        @endif

        <div class="img-title">{{ $estate->price->format() }}</div>
    </div>

    <div class="info-div">
        <p class="description">
            {{ $estate->description }}
        </p>

        <div class="key-value">
            <span class="key">المدينة:-</span>
            <span class="value">{{ $estate->city }}</span>
        </div>

        <div class="key-value">
            <span class="key">المنطقة/الحى:-</span>
            <span class="value">{{ $estate->region }}</span>
        </div>

        <div class="key-value">
            <span class="key">نوع العقار:-</span>
            <span class="value">
                <a href="{{ URL::page('all-estates', $estate->category) }}">
                {{ $estate->category->title }}
                </a>
            </span>
        </div>

        <div class="key-value">
            <span class="key">عدد الغرف:-</span>
            <span class="value">{{ $estate->number_of_rooms }}</span>
        </div>

        <div class="key-value">
            <span class="key">المساحة:-</span>
            <span class="value">{{ $estate->area }}</span>
        </div>

        <div class="key-value">
            <span class="key">السعر:-</span>
            <span class="value">{{ $estate->price }}</span>
        </div>

        @if($estate->ownerInfo->telephone_number)
        <div class="key-value">
            <span class="key">رقم الهاتف:-</span>
            <span class="value">{{ $estate->ownerInfo->telephone_number }}</span>
        </div>
        @endif

        @if($estate->ownerInfo->mobile_number)
        <div class="key-value">
            <span class="key">رقم الجوال:-</span>
            <span class="value">{{ $estate->ownerInfo->mobile_number }}</span>
        </div>
        @endif
    </div>

</div>

<div class="separator"></div>

<div class="main-title">
    <a href="#">مراسلة المعلن</a>
</div>


<div class="row">
    @if($estate->ownerInfo->contact_number)
    <div class="big-icon-pair">
        <img class="img-responsive" src="{{ URL::asset('app/img/icons/telephone.png') }}" alt=""/>
        <a href="#">
            {{ $estate->ownerInfo->contact_number }}
        </a>
    </div>
    @endif

    <div class="big-icon-pair">
        <img class="img-responsive" src="{{ URL::asset('app/img/icons/message.png') }}" alt=""/>
        <a href="mailto:{{ $estate->ownerInfo->contact_email }}" target="_top">
            ارسل بريد إلكترونى للمعلن
        </a>
    </div>
</div>


<hr />

<div class="row">
    <div class="small-icon-pair">
        <img class="img-responsive" src="{{ URL::asset('app/img/icons/star.png') }}" alt=""/>
        <a href="#">أضف إلى المفضلة</a>
    </div>

    <div class="small-icon-pair">
        <img class="img-responsive" src="{{ URL::asset('app/img/icons/stop.png') }}" alt=""/>
        <a href="#">الإبلاغ عن إساءة</a>
    </div>
</div>
<div class="main-title">
    <a href="#">{{ $estate->title }}</a>
</div>


<div class="one-estate">

    <div class="img-div">
        @if($image = $estate->getImage('main'))
        <img class="img-responsive" src="{{ $image->getLargest()->url }}" alt=""/>
        @endif

        <div class="img-title">{{ $estate->price }} جنيه</div>
    </div>

    <div class="info-div">
        <p class="description">
            {{ $estate->description }}
        </p>

        <div class="key-value">
            <span class="key">الخدمة المطلوبة:-</span>
            <span class="value">{{ $estate->getTypeString() }}</span>
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
            <span class="key">المنطقة/الحى:-</span>
            <span class="value">{{ $estate->region }}</span>
        </div>

        <div class="key-value">
            <span class="key">السعر:-</span>
            <span class="value">{{ $estate->price }}</span>
        </div>

        <div class="key-value">
            <span class="key">رقم الهاتف:-</span>
            <span class="value">{{ $estate->ownerInfo->telephone_number }}</span>
        </div>

        <div class="key-value">
            <span class="key">رقم الجوال:-</span>
            <span class="value">{{ $estate->ownerInfo->mobile_number }}</span>
        </div>
    </div>

</div>

<div class="separator"></div>

<div class="main-title">
    <a href="#">مراسلة المعلن</a>
</div>


<div class="row">
    <div class="big-icon-pair">
        <img class="img-responsive" src="{{ URL::asset('app/img/icons/telephone.png') }}" alt=""/>
        <a href="#">
            {{ $estate->ownerInfo->mobile_number }}
        </a>
    </div>

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
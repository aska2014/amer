@if($showNotAcceptedMessage)
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ trans('messages.errors.estate_not_accepted') }}
</div>
@endif

<div class="main-title">
    <a href="#">{{ $estate->title }}</a>
</div>

<div class="one-estate">

    <div class="img-div">
        @if($image = $estate->getImage('main'))
        <img class="img-responsive" src="{{ $image->getNearest(200, 150) }}" alt=""/>
        @endif

        <div class="img-title">{{ $estate->price->format() }}</div>
    </div>

    <div class="info-div">
        <p class="description">
            {{ $estate->description }}
        </p>

        @if($estate->auction)
        <div class="key-value">
            <span class="key">المزاد يبدأ من:-</span>
            <span class="value">{{ $estate->auction->start_price->format() }}</span>
        </div>
        <div class="key-value">
            <span class="key">المزاد ينتهى عند:-</span>
            <span class="value">{{ $estate->auction->end_price->format() }}</span>
        </div>
        <div class="key-value">
            <span class="key">أعلى عرض حتى الأن:-</span>
            <span class="value">{{ $estate->auction->highest_offer_price->format() }}</span>
        </div>
        @endif

        <div class="key-value">
            <span class="key">المحافظة</span>
            <span class="value">{{ $estate->province }}</span>
        </div>

        @if($estate->city)
        <div class="key-value">
            <span class="key">المدينة:-</span>
            <span class="value">{{ $estate->city }}</span>
        </div>
        @endif

        <div class="key-value">
            <span class="key">المنطقة/الحى:-</span>
            <span class="value">{{ $estate->region }}</span>
        </div>

        <div class="key-value">
            <span class="key">نوع العقار:-</span>
            <span class="value">
                <a href="{{ URL::page('estate/all', $estate->category) }}">
                {{ $estate->category->getDescriptiveTitle() }}
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


<!--<hr />-->
<!--<div class="row">-->
<!--    <div class="small-icon-pair">-->
<!--        <img class="img-responsive" src="{{ URL::asset('app/img/icons/star.png') }}" alt=""/>-->
<!--        <a href="#">أضف إلى المفضلة</a>-->
<!--    </div>-->
<!---->
<!--    <div class="small-icon-pair">-->
<!--        <img class="img-responsive" src="{{ URL::asset('app/img/icons/stop.png') }}" alt=""/>-->
<!--        <a href="#">الإبلاغ عن إساءة</a>-->
<!--    </div>-->
<!--</div>-->

@if($showAddAuctionOffer)
<hr />
<div class="main-title" id="login-form-title">
    <a href="#login-form-title">اضف عرضك</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('add-auction', $estate->auction->id) }}" method="POST">
    <div class="form-group">
        <label for="text">السعر</label>
        <input class="form-control" type="text" id="text" name="AuctionOffer[price]" placeholder="المزاد يبدأ من
        {{ $estate->auction->start_price->format() }}" value="{{ Input::old('AuctionOffer.price') }}">
    </div>
    <div class="form-group">
        <label for="text">تفاصيل إضافية</label>
        <textarea class="form-control" rows="4" id="text" name="AuctionOffer[description]">{{ Input::old('AuctionOffer.description') }}</textarea>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">أضف عرضك</button>
    </div>
</form>
@endif

<hr />
<div class="main-title" id="login-form-title">
    <a href="#login-form-title">التعليقات</a>
</div>

<div class="comments">
    @foreach($estate->comments as $comment)
    <div class="comment">
        @if($comment->user)
        <div class="user-name">
            {{ $comment->user->name }}
        </div>
        @endif

        <div class="comment-body">
            {{ $comment->body }}
        </div>
    </div>
    @endforeach
</div>

<div class="clearfix"></div>

@if($showAddComment)
<hr />
<div class="main-title" id="login-form-title">
    <a href="#login-form-title">اضف تعليق</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('add-comment', $estate->id) }}" method="POST">
    <div class="form-group">
        <label for="text">نص التعليق</label>
        <textarea class="form-control" rows="4" id="text" name="Comment[body]">{{ Input::old('Comment.body') }}</textarea>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">أضف</button>
    </div>
</form>
@endif
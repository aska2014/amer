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
            <span class="key">{{ trans('estate.titles.auction_start') }}</span>
            <span class="value">{{ $estate->auction->start_price->format() }}</span>
        </div>
        <div class="key-value">
            <span class="key">{{ trans('estate.titles.auction_end') }}</span>
            <span class="value">{{ $estate->auction->end_price->format() }}</span>
        </div>
        <div class="key-value">
            <span class="key">{{ trans('estate.titles.auction_highest_offer') }}</span>
            <span class="value">{{ $estate->auction->highest_offer_price->format() }}</span>
        </div>
        @endif

        <div class="key-value">
            <span class="key">{{ trans('estate.titles.province') }}</span>
            <span class="value">{{ $estate->province }}</span>
        </div>

        @if($estate->city)
        <div class="key-value">
            <span class="key">{{ trans('estate.titles.city') }}</span>
            <span class="value">{{ $estate->city }}</span>
        </div>
        @endif

        <div class="key-value">
            <span class="key">{{ trans('estate.titles.region') }}</span>
            <span class="value">{{ $estate->region }}</span>
        </div>

        <div class="key-value">
            <span class="key">{{ trans('estate.titles.category') }}</span>
            <span class="value">
                <a href="{{ URL::page('estate/all', $estate->category) }}">
                {{ $estate->category->getDescriptiveTitle() }}
                </a>
            </span>
        </div>

        <div class="key-value">
            <span class="key">{{ trans('estate.titles.number_of_rooms') }}</span>
            <span class="value">{{ $estate->number_of_rooms }}</span>
        </div>

        <div class="key-value">
            <span class="key">{{ trans('estate.titles.area') }}</span>
            <span class="value">{{ $estate->area }}</span>
        </div>

        <div class="key-value">
            <span class="key">{{ trans('estate.titles.price') }}</span>
            <span class="value">{{ $estate->price }}</span>
        </div>

        @if($estate->ownerInfo->telephone_number)
        <div class="key-value">
            <span class="key">{{ trans('estate.titles.telephone') }}</span>
            <span class="value">{{ $estate->ownerInfo->telephone_number }}</span>
        </div>
        @endif

        @if($estate->ownerInfo->mobile_number)
        <div class="key-value">
            <span class="key">{{ trans('estate.titles.mobile') }}</span>
            <span class="value">{{ $estate->ownerInfo->mobile_number }}</span>
        </div>
        @endif
    </div>

</div>

<div class="separator"></div>

<div class="main-title">
    <a href="#">{{ trans('titles.contact_user') }}</a>
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
            {{ trans('words.contact_user_email') }}
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
    <a href="#login-form-title">{{ trans('titles.add_offer') }}</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('add-auction', $estate->auction->id) }}" method="POST">
    <div class="form-group">
        <label for="text">{{ trans('form.offer.price') }}</label>
        <input class="form-control" type="text" id="text" name="AuctionOffer[price]"
               placeholder="{{ trans('form.offer.start_price') }} {{ $estate->auction->start_price->format() }}"
               value="{{ Input::old('AuctionOffer.price') }}">
    </div>
    <div class="form-group">
        <label for="text">{{ trans('form.offer.extra') }}</label>
        <textarea class="form-control" rows="4" id="text" name="AuctionOffer[description]">{{ Input::old('AuctionOffer.description') }}</textarea>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">{{ trans('form.offer.submit') }}</button>
    </div>
</form>
@endif


@if(! $estate->comments->isEmpty())
<hr />
<div class="main-title" id="login-form-title">
    <a href="#login-form-title">{{ trans('titles.comments') }}</a>
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
@endif

<div class="clearfix"></div>

@if($showAddComment)
<hr />
<div class="main-title" id="login-form-title">
    <a href="#login-form-title">{{ trans('titles.add_comment') }}</a>
</div>

<form role="form" class="form-horizontal" action="{{ URL::route('add-comment', $estate->id) }}" method="POST">
    <div class="form-group">
        <label for="text">{{ trans('form.comment.body') }}</label>
        <textarea class="form-control" rows="4" id="text" name="Comment[body]">{{ Input::old('Comment.body') }}</textarea>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-default">{{ trans('form.comment.submit') }}</button>
    </div>
</form>
@endif
<div class="sidebar-menu">

    @if($authUser)
    <div class="menu-item big-if-small">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/control-panel.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('user/estates') }}">{{ trans('menu.my_estates') }}</a>
        </div>
    </div>

    <div class="menu-item big-if-small">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/bookmark.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('user/bookmarks') }}">{{ trans('menu.bookmarks') }}</a>
        </div>
    </div>
    @endif

    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/plus.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('estate/create') }}">{{ trans('menu.create_estate') }}</a>
        </div>
    </div>


    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/paper.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('news/all') }}">{{ trans('menu.latest_news') }}</a>
        </div>
    </div>


    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/dolphin.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('under-construction') }}">{{ trans('menu.sea_services') }}</a>
        </div>
    </div>


    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/best-offer.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('estate/amer-group-specials') }}">{{ trans('menu.amer_group_specials') }}</a>
        </div>
    </div>

    @if($realEstateInvestmentPage)
    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/estate-investment.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('page', $realEstateInvestmentPage) }}">{{ $realEstateInvestmentPage->title }}</a>
        </div>
    </div>
    @endif

</div>
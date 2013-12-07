<div class="sidebar-menu">

    @if($authUser)
    <div class="menu-item big-if-small">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/control-panel.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('user/estates') }}"> اعلاناتي</a>
        </div>
    </div>
    @endif

    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/plus.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('estate/create') }}">أضف عقاراً</a>
        </div>
    </div>


    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/paper.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('news/all') }}">أخر الأخبار</a>
        </div>
    </div>


    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/dolphin.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="#">خدمات بحرية</a>
        </div>
    </div>


    <div class="menu-item">
        <div class="item-icon">
            <img class="img-responsive" src="{{ URL::asset('app/img/icons/best-offer.png') }}" alt=""/>
        </div>

        <div class="item-info">
            <a href="{{ URL::page('estate/amer-group-specials') }}">عروض عامر جروب 2</a>
        </div>
    </div>

</div>
<div class="top-header">

    <div class="choose-language">

        <div class="pull-left">
            <div class="flags">
<!--                <a href=""><div class="france-flag"></div></a>-->
                <a href="{{ URL::route('change-language', 'ar') }}" title="Arabic"><div class="egypt-flag"></div></a>
                <a href="{{ URL::route('change-language', 'en') }}" title="English"><div class="britain-flag"></div></a>
            </div>
            <span>{{ trans('words.choose_language') }}</span>
        </div>

    </div>

    <div class="navbar">

        <ul>
            <li><a href="{{ URL::page('home') }}">{{ trans('menu.home') }}</a></li>

            @foreach($menuPages as $page)
            <li><a href="{{ URL::page('page', $page) }}">{{ $page->title }}</a></li>
            @endforeach

            <li><a href="{{ URL::page('contact-us') }}">{{ trans('menu.contact_us') }}</a></li>

            @if($authUser)
            <li><a href="{{ URL::page('user/estates') }}">{{ $authUser->name }}</a></li>
            <li><a href="{{ URL::route('logout') }}">{{ trans('menu.logout') }}</a></li>
            @else
            <li><a href="{{ URL::page('login/show') }}">{{ trans('menu.login') }}</a></li>
            <li><a href="{{ URL::page('login/show') }}#register-form-title">{{ trans('menu.new_account') }}</a></li>
            @endif
        </ul>

    </div>
</div>
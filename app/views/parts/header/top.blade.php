<div class="top-header">

    <div class="choose-language">

        <div class="pull-left">
            <div class="flags">
<!--                <a href=""><div class="france-flag"></div></a>-->
                <a href="{{ URL::route('change-language', 'ar') }}"><div class="egypt-flag"></div></a>
                <a href="{{ URL::route('change-language', 'en') }}"><div class="britain-flag"></div></a>
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
        </ul>

    </div>
</div>
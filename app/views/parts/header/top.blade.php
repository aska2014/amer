<div class="top-header">

    <div class="choose-language">

        <div class="pull-left">
            <div class="flags">
                <div class="france-flag"></div>
                <div class="egypt-flag"></div>
                <div class="britain-flag"></div>
            </div>
            <span>اختر لغتك</span>
        </div>

    </div>

    <div class="navbar">

        <ul>
            <li><a href="{{ URL::page('home') }}">الرئيسية</a></li>

            @foreach($menuPages as $page)
            <li><a href="{{ URL::page('page', $page) }}">{{ $page->title }}</a></li>
            @endforeach

            <li><a href="{{ URL::page('contact-us') }}">إتصل بنا</a></li>
        </ul>

    </div>
</div>
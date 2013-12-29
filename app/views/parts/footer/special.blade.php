<div class="footer-special" ng-cloak>
    <div class="special-title"></div>

    <div class="special-info">
        <ul id="marquee" class="marquee" dir="rtl">
            @foreach($footerSpecials as $footerSpecial)
            <li onclick="window.location.href = '{{ URL::page('estate/show', $footerSpecial) }}'">
                <em>{{ $footerSpecial->title . ':- ' }}</em>{{ $footerSpecial->description }}
            </li>
            @endforeach
        </ul>
    </div>
</div>
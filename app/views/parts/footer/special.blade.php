<div class="footer-special" ng-controller="SpecialFooterController" ng-cloak>
    <div class="special-title"></div>

    <div class="special-info">
        <a href="{{ URL::page('estate/show', $footerSpecial) }}">
            {{ $footerSpecial->title }}
        </a>
    </div>
</div>
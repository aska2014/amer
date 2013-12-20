<div class="footer-special" ng-controller="SpecialFooterController" ng-cloak ng-show="special != null">
    <div class="special-title"></div>

    <div class="special-info">
        <a ng-href="{{ special.url }}">
            {{ special.title }}
        </a>
    </div>
</div>
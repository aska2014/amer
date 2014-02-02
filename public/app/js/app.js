'use strict';


// Declare app level module which depends on filters, and services
angular.module('amer', ['amer.controllers']);

angular.module('amer.controllers', []).

    controller('MainController', [function()
    {
        $("select[select-value]").each(function()
        {
            $(this).val($(this).attr('select-value'));
        });
    }]).


    controller('SpecialSliderController', [function()
    {

    }]).


    controller('UpgradeEstateController', ['$scope', function($scope)
    {
    }]).

    controller('AddEstateController', ['$scope', function($scope)
    {
        var no_of_images = 0;

        $scope.addImage = function()
        {
            if(no_of_images < 6)

                $(".add-image").before('<input type="file" id="image-input' + (++ no_of_images) + '" name="gallery-imgs[]"/>');
        };

        $scope.initializeAll = function(estate, auction, user)
        {
            $scope.estate = estate;
            $scope.user = user;
            $scope.auction = auction;
        };

        var selectHasValue = function($elem, value)
        {
            return $elem.find("option[value='" + value + "']").length > 0;
        }

        $scope.$watch('estate.estate_category_id', function(category_id)
        {
            // If it exists in the parent category select then directly set it
            if(selectHasValue($('#category-input'), category_id))
            {
                $scope.estate.parent_category_id = category_id;
            }

            else
            {
                $(".child-categories").each(function()
                {
                    if(selectHasValue($(this), category_id))
                    {
                        $scope.estate.parent_category_id = $(this).attr('parent-category-id');
                        $scope.estate.child_category_id  = category_id;
                    }
                });
            }
        });

        var first = true;

        $scope.$watch('estate.parent_category_id', function(parent_category_id)
        {
            if(! first) $scope.estate.child_category_id = 0;
            first = false;

            showRightForm(parent_category_id);
        });

        $scope.getCategoryId = function()
        {
            if($scope.estate.parent_category_id && $scope.estate.child_category_id)
            {
                return $scope.estate.child_category_id;
            }
            else
            {
                return $scope.estate.parent_category_id;
            }
        };

        $scope.$watch('show', function(show)
        {
            console.log($scope.auction);
            $scope.estate.auction = show.auction;

            if(! $scope.estate.number_of_rooms)
            {
                if(! show.number_of_rooms)
                {
                    $scope.estate.number_of_rooms = 0;
                }
                else
                {
                    $scope.estate.number_of_rooms = 1;
                }
            }

            if(! show.area)
            {
                $scope.estate.area = 0;
            }
        });

        var formOptions = {
            // markets
            1: { auction: false, number_of_rooms:false, area: true  },
            // auctions
            2: { auction: true , number_of_rooms:true , area: true  },
            // villas
            3: { auction: false, number_of_rooms:true , area: true  },
            // services
            4: { auction: false, number_of_rooms:false, area: false },
            // groves
            5: { auction: false, number_of_rooms:true, area: true },
            // lands
            6: { auction: false, number_of_rooms:false, area: true },

            // furnished apartments
            7: { auction: false, number_of_rooms:true, area: true },
            // rent apartments
            8: { auction: false, number_of_rooms:true, area: true },
            // owner_apartments
            9: { auction: false, number_of_rooms:true, area: true }
        };

        var showRightForm = function(category_id)
        {
            $scope.show = formOptions[category_id];
        }

    }]);

(function(A){A.marquee={version:"1.0.01"};A.fn.marquee=function(E){var F=typeof arguments[0]=="string"&&arguments[0];var D=F&&Array.prototype.slice.call(arguments,1)||arguments;var C=(this.length==0)?null:A.data(this[0],"marquee");if(C&&F&&this.length){if(F.toLowerCase()=="object"){return C}else{if(C[F]){var B;this.each(function(G){var H=A.data(this,"marquee")[F].apply(C,D);if(G==0&&H){if(!!H.jquery){B=A([]).add(H)}else{B=H;return false}}else{if(!!H&&!!H.jquery){B=B.add(H)}}});return B||this}else{return this}}}else{return this.each(function(){new A.Marquee(this,E)})}};A.Marquee=function(E,Q){Q=A.extend({},A.Marquee.defaults,Q);var O=this,M=A(E),F=M.find("> li"),H=-1,G=false,L=false,N=0;A.data(M[0],"marquee",O);this.pause=function(){G=true;P()};this.resume=function(){G=false;D()};this.update=function(){var R=F.length;F=M.find("> li");if(R<=1){D()}};function K(R){if(F.filter("."+Q.cssShowing).length>0){return false}var T=F.eq(R);if(A.isFunction(Q.beforeshow)){Q.beforeshow.apply(O,[M,T])}var S={top:(Q.yScroll=="top"?"-":"+")+T.outerHeight()+"px",right:0};M.data("marquee.showing",true);T.addClass(Q.cssShowing);T.css(S).animate({top:"0px"},Q.showSpeed,Q.fxEasingShow,function(){if(A.isFunction(Q.show)){Q.show.apply(O,[M,T])}M.data("marquee.showing",false);J(T)})}function J(S,R){if(L==true){return false}R=R||Q.pauseSpeed;if(C(S)){setTimeout(function(){if(L==true){return false}var V=S.outerWidth(),T=V*-1,U=parseInt(S.css("right"),10);S.animate({right:T+"px"},((V+U)*Q.scrollSpeed),Q.fxEasingScroll,function(){I(S)})},R)}else{if(F.length>1){setTimeout(function(){if(L==true){return false}S.animate({top:(Q.yScroll=="top"?"+":"-")+M.innerHeight()+"px"},Q.showSpeed,Q.fxEasingScroll);I(S)},R)}}}function I(R){if(A.isFunction(Q.aftershow)){Q.aftershow.apply(O,[M,R])}R.removeClass(Q.cssShowing);B()}function P(){L=true;if(M.data("marquee.showing")!=true){F.filter("."+Q.cssShowing).dequeue().stop()}}function D(){L=false;if(M.data("marquee.showing")!=true){J(F.filter("."+Q.cssShowing),1)}}if(Q.pauseOnHover){M.hover(function(){if(G){return false}P()},function(){if(G){return false}D()})}function C(R){return(R.outerWidth()>M.innerWidth())}function B(){H++;if(H>=F.length){if(!isNaN(Q.loop)&&Q.loop>0&&(++N>=Q.loop)){return false}H=0}K(H)}if(A.isFunction(Q.init)){Q.init.apply(O,[M,Q])}B()};A.Marquee.defaults={yScroll:"top",showSpeed:850,scrollSpeed:12,pauseSpeed:5000,pauseOnHover:true,loop:-1,fxEasingShow:"swing",fxEasingScroll:"linear",cssShowing:"marquee-showing",init:null,beforeshow:null,show:null,aftershow:null}})(jQuery);

$(document).ready(function (){
    $("#news-marquee").marquee({yScroll: "top", pauseSpeed: 10000});

    $("#footer-marquee").marquee({yScroll: "top", pauseSpeed: 5000});
});
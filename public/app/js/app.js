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


    controller('UpgradeEstateController', ['$scope', function($scope)
    {
    }]).


    controller('SpecialFooterController', ['$scope', function($scope)
    {
        var ids = [];

        $scope.special = null;

        $(".footer-special").hide();

        var makeFooterRequest = function()
        {
            if($(".footer-special").is(":visible"))
                $(".footer-special").slideUp(100);

            $.ajax({
                url: '/request/footer-specials',
                type: 'GET',
                data: {
                    except: ids
                },
                success: function(response)
                {
                    if(typeof response['id'] !== "undefined")
                    {
                        $(".footer-special").slideDown(1000);

                        $scope.special = response;

                        ids.push($scope.special.id);

                        $scope.$apply();
                    }
                }
            });
        };

        makeFooterRequest();

        setInterval(makeFooterRequest, 9000);
    }]).

    controller('AddEstateController', ['$scope', function($scope)
    {
        var selectHasValue = function($elem, value)
        {
            return $elem.find("option[value='" + value + "']").length > 0;
        }

        $scope.$watch('estate.category_id', function(category_id)
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

        var mapper = {
            1: 'markets',
            2: 'auctions',
            4: 'services',
            6: 'lands'
        };

        $scope.$watch('show', function(show)
        {
            console.log(show);

            $scope.estate.auction = show.auction;

            if(! show.number_of_rooms)
            {
                $scope.estate.number_of_rooms = 0;
            }
            else
            {
                $scope.estate.number_of_rooms = 1;
            }

            if(! show.area)
            {
                $scope.estate.area = 0;
            }
        });

        var showRightForm = function(category_id)
        {
            $scope.show = { auction: false, number_of_rooms:false, area: false };

            switch(mapper[category_id])
            {
                case 'auctions':
                    $scope.show = { auction:true, number_of_rooms:true, area:true };
                    break;
                case 'services':
                    // All are already false
                    break;
                case 'lands':
                    // All are already false
                    break;
                case 'markets':
                    $scope.show = { number_of_rooms:true, area:true };
                    break;
                default:
                    $scope.show = { number_of_rooms:true, area:true };
                    break;
            }
        }

    }]);
'use strict';


// Declare app level module which depends on filters, and services
angular.module('amer', ['amer.controllers']);

angular.module('amer.controllers', []).


    controller('UpgradeEstateController', ['$scope', function($scope)
    {
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
                        $scope.estate.child_category_id  = category_id;
                        $scope.estate.parent_category_id = $(this).attr('parent-category-id');
                    }
                });
            }
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

    }]);
'use strict';


// Declare app level module which depends on filters, and services
angular.module('amer', ['amer.controllers']);

angular.module('amer.controllers', []).

    controller('AddEstateController', ['$scope', function($scope)
    {
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
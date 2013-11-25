'use strict';

/* Controllers */

angular.module('amer.controllers').

    controller('AddEstateController', ['$scope', function($scope)
    {
        // Which is the required service
        $scope.estateType = 'for-sale';

        $scope.isAuction = function()
        {
            return $scope.estateType == 'auction';
        };

    }]);
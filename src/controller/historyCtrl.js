app.controller('historyCtrl',['$scope','$rootScope','historyService',function($scope,$rootScope,historyService){

    $scope.currentPage = 1;
    $scope.totalItems = 0;
    $scope.pageSize = 10;
    $scope.searchText = '';
    $scope.getFrontHistory = function(){
        historyService.getFrontHistory($scope.currentPage,$scope.pageSize,$scope.searchText,$scope);
    }
    $scope.pageChanged = function() {
        $scope.getFrontHistory();
    }
    $scope.pageSizeChanged = function() {
        $scope.currentPage = 1;
        $scope.getFrontHistory();
    }
    $scope.searchTextChanged = function() {
        $scope.currentPage = 1;
        $scope.getFrontHistory();
    }
}]);
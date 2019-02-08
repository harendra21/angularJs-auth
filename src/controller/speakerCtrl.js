app.controller('speakerCtrl',['$scope','$rootScope','speakerService',function($scope,$rootScope,speakerService){
    $scope.spakerAdd = true;
    $scope.showAlert('info','Add / Update Spekaer');
    $scope.activity = []; 
    $scope.currentPage = 1;
    $scope.totalItems = 0;
    $scope.pageSize = 10;
    $scope.searchText = '';
    $scope.getSpeaker = function(){
        speakerService.getSpeaker($scope.currentPage,$scope.pageSize,$scope.searchText,$scope);
    }
    $scope.pageChanged = function() {
        $scope.getSpeaker();
    }
    $scope.pageSizeChanged = function() {
        $scope.currentPage = 1;
        $scope.getSpeaker();
    }
    $scope.searchTextChanged = function() {
        $scope.currentPage = 1;
        $scope.getSpeaker();
    }
    $scope.editSpeaker = function(data){
        $scope.speaker = data;
        $scope.spakerAdd = false;
    }
    $scope.clearForm = function(){
        $scope.speaker = {};
        $scope.catAdd = true;
    }
    $scope.addupdateSpeaker = function(formData){
        if(!formData)
            $scope.showAlert('error','Please enter a valid category details');
        else if(!formData.category_name)
            $scope.showAlert('error','Please enter a valid category name');
        else if(!formData.category_description)
            $scope.showAlert('error','Please enter a valid category description');
        else if(!formData.category_page_title)
            $scope.showAlert('warning','Please enter a valid category page title');
        else if(!formData.category_meta_keyword)
            $scope.showAlert('warning','Please enter a valid category meta keywords');
        else if(!formData.category_meta_description)
            $scope.showAlert('warning','Please enter a valid category meta description');
        else{
            speakerService.addeditCategory(formData,$scope);
            $scope.clearForm();
        }
    }
}]);
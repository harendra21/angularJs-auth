app.controller('categoryCtrl',['$scope','$rootScope','categoryService',function($scope,$rootScope,categoryService){
    $scope.catAdd = true;
    $scope.showAlert('info','Add / Update Category');
    $scope.activity = []; 
    $scope.currentPage = 1;
    $scope.totalItems = 0;
    $scope.pageSize = 10;
    $scope.searchText = '';
    $scope.getCategory = function(){
        categoryService.getCategory($scope.currentPage,$scope.pageSize,$scope.searchText,$scope);
    }
    $scope.pageChanged = function() {
        $scope.getCategory();
    }
    $scope.pageSizeChanged = function() {
        $scope.currentPage = 1;
        $scope.getCategory();
    }
    $scope.searchTextChanged = function() {
        $scope.currentPage = 1;
        $scope.getCategory();
    }
    $scope.editCategory = function(data){
        $scope.cat = data;
        $scope.catAdd = false;
    }
    $scope.clearForm = function(){
        $scope.cat = {};
        $scope.catAdd = true;
    }
    $scope.addupdateCategory = function(formData){
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
            categoryService.addeditCategory(formData,$scope);
            $scope.clearForm();
        }
    }
}]);
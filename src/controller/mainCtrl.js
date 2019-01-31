app.controller('mainCtrl',function($scope,$rootScope,authService,$http,$aside){
    
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    $http.defaults.headers.common["Authorization"] = "Token "+sessionStorage.loggedInToken;

    authService.isLoggedIn();
    $scope.showLoader = false;
    
    $scope.showAlert = function(type,message){

        if(type === 'error')
            eType = 'danger';
        else if(type === 'success')
            eType = 'success';
        else if(type === 'info')
            eType = 'info';
        else if(type === 'warning')
            eType = 'warning';
        $scope.alerts = [
            { type: eType, msg: message },
        ];
    }
    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };

    $scope.logOut = function(){
        
        authService.logOut();
    }
    $scope.loadScript = function(path){
        $ocLazyLoad.load(path)
    }


    $scope.asideState = {
        open: false
    };
      
    $scope.openAside = function(position, backdrop) {
        $scope.asideState = {
          open: true,
          position: position
        };
        
        function postClose() {
          $scope.asideState.open = false;
        }
        $aside.open({
          templateUrl: 'view/_parts/aside.html',
          placement: position,
          size: 'sm',
          backdrop: backdrop,
          controller: function($scope, $uibModalInstance) {
            $scope.ok = function(e) {
              $uibModalInstance.close();
              e.stopPropagation();
            };
            $scope.cancel = function(e) {
              $uibModalInstance.dismiss();
              e.stopPropagation();
            };
          }
        }).result.then(postClose, postClose);
    };
    $rootScope.$on('loading:progress', function (){
        $scope.showLoader = true;
    });
    $rootScope.$on('loading:finish', function (){
        $scope.showLoader = false;
    });
});
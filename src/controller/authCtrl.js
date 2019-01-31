app.controller('authCtrl',function($scope,authService){
    $scope.showAlert('info','Please enter a valid credintials to login.');
    $scope.userLogin = function(formData){
        
        if(!formData)
            $scope.showAlert('error','Please enter a valid credintials to login.');
        else if(!formData.email)
            $scope.showAlert('error','Please enter a valid email.');
        else if(!formData.email.match(mailformat))
            $scope.showAlert('warning','Your email is not valid. Please enter a valid email.');
        else if(!formData.password)
            $scope.showAlert('error','Please enter a valid password.');
        else if(formData.password.length < 8)
            $scope.showAlert('warning','Password should must be 8 charectrs long.Please enter a valid password.');
        else{
            $scope.showAlert('info','Logging in.');
            var email = formData.email;
            var password = formData.password;
            authService.login(email,password,$scope);
        }
            
    }
});
app.controller('profileCtrl',['$scope','$rootScope','mainService',function($scope,$rootScope,mainService){
    $scope.showDetails = true;

    $scope.editProfileFieldShow = function(){
        $scope.showDetails = false;
    }

    $scope.uploadFile = function(element) {   
    var data = new FormData();
        data.append('file', $(element)[0].files[0]);
        jQuery.ajax({
            url: baseUrl+'fileupload?type=image&for=profile',
            type:'post',
            data: data,
            contentType: false,
            processData: false,
            success: function(response) {
            if(response){
                $scope.userDetails.image = response;
                
            }
            },
            error: function(jqXHR, textStatus, errorMessage) {
            alert('Error uploading: ' + errorMessage);
            }
        });   
    };

    $scope.updateProfile = function(formData){
        if(!formData)
            $scope.showAlert('error','Please enter a valid user details');
        else if(!formData.fName)
            $scope.showAlert('error','Please enter a valid first name');
        else if(!formData.role)
            $scope.showAlert('warning','Please enter a valide role');
        else{
            var email = formData.email;
            var password = formData.password;
            mainService.updateProfile(formData,$scope);
        }
    };
}]);
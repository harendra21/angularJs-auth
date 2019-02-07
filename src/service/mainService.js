app.service('mainService',function($location,$rootScope,$http){
    var that = this;
    this.updateProfile = function(data,scope){
        $http({
            url: baseUrl+'profile/updateProfile',
            method: "POST",
            data : data
        })
        .then(function(response) {
            if(response.data.status === 'invalid'){
                that.logOut();
            }else if(response.data.status == 'success'){
                
                scope.showAlert('success',response.data.msg);
            }
        });
    }
    
    

});
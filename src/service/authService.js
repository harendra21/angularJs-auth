app.service('authService', function ( $location, $rootScope, $http ){
    var that = this;
    this.isLoggedIn = function(){
        if(!sessionStorage.isLoggedIn ){
            $rootScope.loggedUserEmail = '';
            $rootScope.isLoggedIn = false;
            return false;
        }else{
            //$rootScope.loggedUserEmail = sessionStorage.loggedInToken;
            
            $rootScope.isLoggedIn = true;
            
            if(!$rootScope.userDetails){
                
                $http({
                    url: baseUrl+'auth/loginUserDetails',
                    //headers : { 'Authorization' : 'Token '+sessionStorage.loggedInToken,'Accept': 'application/json',"X-Login-Ajax-call": 'true' },
                    method: "GET"
                })
                .then(function(response) {
                    //console.log(response.data.status);
                    if(response.data.status === 'invalid'){
                        that.logOut();
                    }else if(response.data.status == 'success'){
                        var user = response.data.data;
                        $rootScope.userDetails = user;
                        $rootScope.userFullName = user.fName+' '+user.mName+' '+user.lName;
                        $rootScope.userRole = user.role;
                        $rootScope.userLastLogin = user.lastLogin;
                        
                    }
                    
                });
            }

            return true;
        }
    },
    this.login = function(email,password,scope){
        var formData = { 'loginEmail' : email, 'loginPassword' : password }
        $http({
            url: baseUrl+'auth/login',
            method: "POST",
            data: { 'fromData' : formData }
        })
        .then(function(response) {
            if(response.data){

                if(response.data.error === true && response.data.status === 'error'){
                    scope.showAlert('error',response.data.msg);
                    scope.login.password = '';
                }else if(response.data.error === false && response.data.status === 'success'){
                    scope.showAlert('success',response.data.msg);
                    sessionStorage.isLoggedIn = true;
                    sessionStorage.loggedInToken = response.data.data;
                    window.location.reload();
                    // that.isLoggedIn();
                    // $location.path('/');
                }

            }else{
                scope.showAlert('error','Something went wrong. Please try again');
                scope.login.password = '';
            }
        }, 
        function(response) { // optional
            // failed
            scope.showAlert('error','Something went wrong. Please try again');
            scope.login.password = '';
        });


        
    },
    this.isLoggedInRoute = function(){
        if(!sessionStorage.isLoggedIn && sessionStorage.isLoggedIn !== true ){
            that.isLoggedIn();
            $location.path('/login');
        }
    },
    this.isLoggedInOnAuth = function(){
        if(sessionStorage.isLoggedIn){
            $location.path('/');
        }
    },
    this.logOut = function(){
        sessionStorage.isLoggedIn = '';
        sessionStorage.loggedInData = '';
        sessionStorage.loggedInToken = '';
        that.isLoggedIn();
        $location.path('/login');
        
    },
    
    this.loggedUserEmail = function(){
        return sessionStorage.loggedInData;
    }
});
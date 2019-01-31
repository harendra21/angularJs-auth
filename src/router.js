app.config(function($routeProvider,$controllerProvider) {
    app.controller = $controllerProvider.register;
    $routeProvider
    .when("/", {
      resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
          return $ocLazyLoad.load([{
            files: ['src/controller/homeCtrl.js']
          }]);
        }],
        check : function(authService){
          authService.isLoggedInRoute();
        } 
      },
      controller : 'homeCtrl',
      templateUrl : "view/home.html"
        
    }).when("/my-profile", {
      resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
          return $ocLazyLoad.load([{
            files: ['src/controller/myProfileCtrl.js']
          }]);
        }],
        check : function(authService){
          authService.isLoggedInRoute();
        } 
      },
      controller : 'profileCtrl',
      templateUrl : "view/profile/my-profile.html"
        
    }).when("/history/front-history", {
      resolve: {
        lazy: ['$ocLazyLoad', function($ocLazyLoad) {
          return $ocLazyLoad.load([{
            files: ['src/controller/historyCtrl.js']
          }]);
        }],
        check : function(authService){
          authService.isLoggedInRoute();
        } 
      },
      controller : 'historyCtrl',
      templateUrl : "view/history/front-history.html"
        
    }).when("/login", {
        controller : 'authCtrl',
        templateUrl : "view/auth/login.html",
        resolve: {
            lazy: ['$ocLazyLoad', function($ocLazyLoad) {
              return $ocLazyLoad.load([{
                files: ['src/controller/authCtrl.js']
              }]);
            }],
            check : function(authService){
              authService.isLoggedInOnAuth();
            }
          }
    }).when("/register", {
        controller : 'authCtrl',
        templateUrl : "view/auth/register.html",
        resolve: {
            lazy: ['$ocLazyLoad', function($ocLazyLoad) {
              return $ocLazyLoad.load([{
                files: ['src/controller/authCtrl.js']
              }]);
            }],
            check : function(authService){
              authService.isLoggedInOnAuth();
            }
          }
    }).otherwise({ templateUrl : "view/error/404.html" });
  });
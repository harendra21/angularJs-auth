var app = angular.module('mainApp',['ngRoute','ngAnimate','ngAria','ui.bootstrap','oc.lazyLoad','angular-loading-bar','ngAside']);
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);

app.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);
var baseUrl = 'http://localhost:8000/';

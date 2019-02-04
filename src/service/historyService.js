app.service('historyService',function($location,$rootScope,$http){
    var that = this;
    this.getFrontHistory = function(currentPage,pageSize,searchText,scope){
        $http({
            url: baseUrl+'history/getFrontHistory?page=' + currentPage + '&size=' + pageSize + '&search=' + searchText,
            method: "GET"
        })
        .then(function(response) {
            if(response.data.status == 'invalid'){
                that.isLoggedInRoute();
            }else if(response.data.status == 'success'){
                var history = response.data.data;
                scope.activity = history.history;
                //scope.activity = [];
                scope.totalItems = history.count;
                scope.startItem = (currentPage - 1) * pageSize + 1;
                scope.endItem = currentPage * pageSize;
                if (endItem > scope.totalItems) {endItem = scope.totalItems;}
                // angular.forEach(history.history, function(temp){
                //     scope.activity.push(temp);
                // });
  
            }
        });
    }
});
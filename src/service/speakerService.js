app.service('speakerService',function($location,$rootScope,$http){
    var that = this;
    this.getSpeaker = function(currentPage,pageSize,searchText,scope){
        $http({
            url: baseUrl+'speaker/get-speaker?page=' + currentPage + '&size=' + pageSize + '&search=' + searchText,
            method: "GET"
        })
        .then(function(response) {
            if(response.data.status === 'invalid'){
                that.logOut();
            }else if(response.data.status === 'success'){
                var cat = response.data.data;
                scope.results = cat.speaker;
                scope.totalItems = cat.count;
                scope.startItem = (currentPage - 1) * pageSize + 1;
                scope.endItem = currentPage * pageSize;
                if (endItem > scope.totalItems) {endItem = scope.totalItems;}
            }
        });
    },
    this.addeditSpeaker = function(data,scope){
        

        $http({
            url: baseUrl+'category/addeditCategory',
            method: "POST",
            data: { 'formData' : data }
        })
        .then(function(response) {
            if(response.data.status === 'invalid'){
                that.logOut();
            }else if(response.data.status === 'error'){
                scope.showAlert('error',response.data.msg);
            }else if(response.data.status === 'success'){
                scope.getCategory();
                scope.showAlert('success',response.data.msg);
            }
        });

    }
   
});

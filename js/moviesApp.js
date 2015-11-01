var app = angular.module('moviesApp', ['ngAnimate']);
app.controller('moviesController', function($scope, $http, $sce) {
	// load more button visibility
	$scope.loadMoreVisi = true;

	// get the first page
	$http.get(document.getElementById('movies').getAttribute('data-ajax'))
		.success(function (response) {
			// seprate response JSON data to 2 seprate onject
			// next/prev/first/last link page in JSON
			$scope.links = response.links;

			// actuall data
			$scope.data = response.data;

			// make sure short_description is not escaped and showing HTML
			angular.forEach($scope.data, function(value, key) {
				value.short_description = $sce.trustAsHtml(value.short_description);
			});
		});

	$scope.loadMore = function(){
		// load next page
		var nextPage = document.getElementById('load-more').getAttribute('data-next');		
		$http.get(nextPage)
		.success(function (response) {
				var links = response.links;
				var data = response.data;
				angular.forEach(data, function(value, key) {
					value.short_description = $sce.trustAsHtml(value.short_description);
			});
			// contcat to current data
			$scope.data = $scope.data.concat(data);

			// replace links
			$scope.links = angular.copy(links);

			// if we are loading the last page so we can hide the load more bottom
			if (links.last.href == nextPage)
				$scope.loadMoreVisi = false;
		});
	};
});
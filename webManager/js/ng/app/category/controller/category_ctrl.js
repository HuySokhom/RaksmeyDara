app.controller(
	'category_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$location'
	, 'Upload'
	, 'alertify'
	, '$timeout'
	, function ($scope, Restful, Services, $location, Upload, $alertify, $timeout){
		var vm = this;
		vm.service = new Services();
		var url = "api/Category/";
		vm.totalItems = 0;
		var params = {pagination: 'yes', filter: vm.filterText};
		function init(params){
			vm.loading = true;
			Restful.get(url, params).success(function(data){
				vm.category = data;
				vm.totalItems = data.count;
			}).finally(function(){
				vm.loading = false;
			});
		};
		init(params);
		vm.filters = function(){
			init(params);
		};
		vm.remove = function($index, params){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("<b>Waring: </b>If you delete this category it will " +
						"delete all product that use this category.", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( url + params.categories_id, params ).success(function(data){
						vm.disabled = true;
						vm.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						init(params);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};
			vm.itemsByPage = 10;
		/**
		 * start functionality pagination
		 */
		vm.currentPage = 1;
		//get another portions of data on page changed
		vm.pageChanged = function() {
			vm.pageSize = 10 * (vm.currentPage - 1 );
			params.start = vm.pageSize;
			init(params);
		};
	}
]);
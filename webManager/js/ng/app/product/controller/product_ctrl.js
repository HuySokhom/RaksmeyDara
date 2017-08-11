app.controller(
	'product_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$state'
	, 'alertify'
	, function ($scope, Restful, Services, $state, $alertify){
		var vm = this;
		vm.service = new Services();
		vm.sortType = [
			{
				id: 0,
				name: 'Free Plan'
			},
			{
				id: 1,
				name: 'Basic Plan'
			},
			{
				id: 2,
				name: 'Premium Plan'
			},
			{
				id: 3,
				name: 'Pro Plan'
			},
		];
		var params = {};
		var url = 'api/Product/';
		function init(params){
			Restful.get(url, params).success(function(data){
				vm.products = data;
				vm.totalItems = data.count;
				console.log(data);
			});
			Restful.get("api/Category").success(function(data){
				vm.categoryList = data;
			});
		};
		init(params);

		vm.edit = function(params){
			console.log(params);
			$state.go('product.edit', {id: params.id});
		};

		vm.remove = function(id){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("Are you sure you want to delete this product?", function (ev) {
					ev.preventDefault();
					Restful.delete( url + id, params ).success(function(data){
						vm.disabled = true;
						vm.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						//$scope.products.elements.splice($index, 1);
						init(params);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};

		vm.refreshDate = function(param){
			Restful.patch(url + param.id).success(function(data){
				init(params);
			});
		};

		vm.updateStatus = function(params){
			params.products_status == 1 ? params.products_status = 0 : params.products_status = 1;
			var data = { status: params.products_status, name: "update_status"};
			Restful.patch(url + params.id, data).success(function(data){console.log(data);
				vm.service.alertMessage('<strong>Complete: </strong> Update Status Success.');
			});
		};

		vm.link = function(id){
			window.open('-p-' + id + '.html','_blank');
		};
		// search functionality
		vm.filter = function(){
			params.filter_text = vm.filterText;
			params.category_id = vm.category_id;
			init(params);
		};
		/**
		 * start functionality pagination
		 */
		vm.currentPage = 1;
		//get another portions of data on page changed
		vm.pageChanged = function() {
			vm.pageSize = 10 * ( vm.currentPage - 1 );
			params.start = vm.pageSize;
			init(params);
		};
	}
]);
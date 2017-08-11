app.controller(
	'category_create_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$state'
	, '$stateParams'
	, 'Upload'
	, 'alertify'
	, '$window'
	, '$anchorScroll'
	, function ($scope, Restful, Services, $state, $stateParams, Upload, $alertify, window, $anchorScroll){
		var vm = this;
		vm.service = new Services();
		var url = "api/Category/";
		function init(){
			Restful.get(url).success(function(data){
				vm.category = data.elements;
				console.log(data);
			});
			if($state.current.name == 'category.edit'){
				vm.title = 'Edit Category';
				Restful.get(url + $stateParams.id).success(function(data){
					console.log(data);
					vm.model = data.elements[0];
					vm.model.name = data.elements[0].detail[0].categories_name;
				});
			}else{
				vm.title = 'Create New Category';
			}
		};
		init();

		vm.cancel = function(){
			window.history.back();
		};

		vm.save = function(){
			if (!$scope.form.$valid) {
				$anchorScroll();
				return;
			}
			var data = {
				category: [{
					parent_id: vm.model.parent_id,
					sort_order: vm.model.sort_order,
				}],
				detail: [
					{
						categories_name: vm.model.name,
						language_id: 1
					}
				]
			};console.log(data);
			vm.loading = true;
			if( vm.model.categories_id ){
				Restful.put(url + vm.model.categories_id, data).success(function(data){
					vm.service.alertMessage('<strong>Complete: </strong>Save Success.');
					vm.loading = false;
					vm.cancel();
				});
			}else{
				Restful.post(url, data).success(function(data){
					vm.service.alertMessage('<strong>Complete: </strong>Save Success.');
					vm.loading = false;
					vm.cancel();
				});
			}
		};
	}
]);
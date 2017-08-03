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
					vm.model = data.item[0];				
				});
			}else{
				vm.title = 'Create New Category';
			}
		};
		init();

		vm.cancel = function(){
			window.history.back();
		};

		vm.save = function(){console.log($scope.form.$valid);
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
			if( vm.id ){
				Restful.put(url + vm.id, data).success(function(data){
					vm.service.alertMessage('<strong>Complete: </strong>Save Success.');
					vm.loading = false;
				});
			}else{
				Restful.post(url, data).success(function(data){
					vm.service.alertMessage('<strong>Complete: </strong>Save Success.');
					vm.loading = false;
				});
			}
		};
	}
]);
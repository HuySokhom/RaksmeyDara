app.controller(
	'social_media_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, 'Services'
	, function ($scope, Restful, $location, Services){
		var vm = this;
		vm.service = new Services();

		var url = 'api/SocialMedia/';
		vm.init = function(params){
			Restful.get(url).success(function(data){
				vm.model = data;
			});
		};
		vm.init();

		// save functionality
		vm.save = function(){
			vm.isDisabled = true;
			if( vm.data.id ){
				console.log(vm.data);
				Restful.put(url + vm.data.id, vm.data).success(function(data){
					console.log(data);
					vm.init();
					$('#modal-popup').modal('hide');
					vm.isDisabled = false;
					vm.service.alertMessage('<strong>Complete: </strong>Update Success.');
				});
			}
		};

		// edit functionality
		vm.edit = function(params){
			vm.data = params;
			$('#modal-popup').modal('show');
		};

	}
]);

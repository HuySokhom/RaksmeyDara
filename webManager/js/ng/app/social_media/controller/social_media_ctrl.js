app.controller(
	'social_media_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, 'Services'
	, function ($scope, Restful, $location, Services){
		var vm = this;
		vm.service = new Services();

		var url = 'api/Content/';
		vm.init = function(params){
			Restful.get(url).success(function(data){
				vm.contents = data;
			});
		};
		vm.init();

		// save functionality
		vm.save = function(){
			var data = {
				pages_title: vm.title,
				pages_content: vm.content,
				language_id: vm.language_id,
			};
			vm.isDisabled = true;
			if( vm.id ){
				console.log(data);
				Restful.put(url + vm.id, data).success(function(data){
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
			vm.content = params.pages_content;
			vm.id = params.id;
			vm.title = params.pages_title;
			vm.language_id = params.language_id;
			$('#modal-popup').modal('show');
		};

	}
]);

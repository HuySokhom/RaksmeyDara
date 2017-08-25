app.controller(
	'content_ctrl', [
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
			var data = [{
					pages_title: vm.title_en,
					pages_content: vm.description_en,
					language_id: 1,
				},{
					pages_title: vm.title_kh,
					pages_content: vm.description_kh,
					language_id: 2,
				}
			];
			vm.isDisabled = true;
			if( vm.id ){
				console.log(data);
				Restful.put(url + vm.id, data).success(function(data){
					console.log(data);
					vm.init();	
					$('#contentPopup').modal('hide');
					vm.isDisabled = false;
					vm.service.alertMessage('<strong>Complete: </strong>Update Success.');
				});
			}
		};

		// edit functionality
		vm.edit = function(params){
			console.log(params);
			vm.id = params.id;
			vm.title_en = params.detail[0].pages_title;
			vm.title_kh = params.detail[1].pages_title;
			vm.description_en = params.detail[0].pages_content;
			vm.description_kh = params.detail[1].pages_content;
			$('#contentPopup').modal('show');
		};

	}
]);

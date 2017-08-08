app.controller(
	'image_slider_ctrl', [
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
		
		vm.add = function(){
			$scope.form.$submitted = false;
			vm.model = {};
			if(vm.picFile){
				vm.picFile = null;
			}
		};
		vm.totalItems = 0;
		function init(params){
			Restful.get(params).success(function(data){
				vm.image_sliders = data;
				vm.totalItems = data.count;
			});
		};
		init('api/ImageSlider');

		vm.edit = function(params){
			$('#imagePopup').modal('show');
			vm.model = angular.copy(params);
			if(vm.picFile){
				vm.picFile = null;
			}
		};

		vm.updateStatus = function(params){
			params.status === 1 ? params.status = 0 : params.status = 1;
			Restful.patch('api/ImageSlider/' + params.id, params ).success(function(data) {
				vm.service.alertMessage('<strong>Success: </strong>Update Success.');
			});
		};

		vm.save = function(){
			if (!$scope.form.$valid) {
				return;
			}
			vm.loading = true;
			if( vm.model.id ){
				Restful.put('api/ImageSlider/' + vm.model.id, vm.model).success(function(data){
					init('api/ImageSlider/');
					$('#imagePopup').modal('hide');
					vm.service.alertMessage('<strong>Complete: </strong>Delete Success.');
					vm.loading = false;
				});
			}else{
				Restful.post('api/ImageSlider/', vm.model).success(function(data){
					init('api/ImageSlider');console.log(data);
					vm.service.alertMessage('<strong>Complete: </strong>Delete Success.');
					$('#imagePopup').modal('hide')
					vm.loading = false;
				});
			}
		};

		vm.remove = function($index, params){
			$alertify.okBtn("Ok")
				.cancelBtn("Cancel")
				.confirm("Are you sure you want to delete this image?", function (ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
					Restful.delete( 'api/ImageSlider/' + params.id, params ).success(function(data){
						vm.loading = true;console.log(data);
						vm.service.alertMessage('<strong>Complete: </strong>Delete Success.');
						vm.image_sliders.elements.splice($index, 1);
					});
				}, function(ev) {
					// The click event is in the
					// event variable, so you can use
					// it here.
					ev.preventDefault();
				});
		};

		vm.cancel = function(){
			$('#imagePopup').modal('hide');
		};

		//functionality upload
		vm.uploadPic = function(file) {
			if (file) {
				file.upload = Upload.upload({
					url: 'api/ImageUploadSlider',
					data: {file: file},
				});
				file.upload.then(function (response) {
					$timeout(function () {console.log(response);
						file.result = response.data;
						vm.model.image = response.data.image;
						vm.model.image_thumbnail = response.data.image_thumbnail;
						//file.result.substring(1, file.result.length - 1);
					});
				}, function (response) {
					if (response.status > 0)
						vm.errorMsg = response.status + ': ' + response.data;
				}, function (evt) {
					// Math.min is to fix IE which reports 200% sometimes
					file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
				});
			}
		};

		/**
		 * start functionality pagination
		 */
		var params = {};
		vm.currentPage = 1;
		//get another portions of data on page changed
		vm.pageChanged = function() {
			vm.pageSize = 10 * (vm.currentPage - 1 );
			params.start = vm.pageSize;
			init(params);
		};
	}
]);
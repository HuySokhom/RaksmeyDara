app.controller(
	'product_post_ctrl', [
	'$scope'
	, 'Restful'
	, 'Services'
	, '$state'
	, 'Upload'
	, '$timeout'
	, '$stateParams'
	, '$anchorScroll'
	, function ($scope, Restful, Services, $state, Upload, $timeout, $stateParams, $anchorScroll){
		var vm = this;
		vm.service = new Services();
		// init tiny option
		vm.tinymceOptions = {
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern media"
			],
			toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			paste_data_images: true
		};
		vm.optionalImage = [];
		vm.disabled = true;
		vm.productDescription = {
			products_name: '',
			products_description: '',
			language_id: 1
		};
		vm.product = {
			products_image: 'images/image-upload.png',
			products_image_thumbnail: 'images/image-upload.png'
		};
		
		// init category
		vm.init = function(){
			Restful.get("api/Category").success(function(data){
				vm.categoryList = data;
			});
			if($state.current.name == 'product.edit'){
				vm.title = 'Edit Product';
				Restful.get("api/Product/" + $stateParams.id).success(function(data){
					console.log(data);
					vm.product = data.elements[0];
					vm.productDescription.products_description_en = data.elements[0].product_detail[0].products_description;
					vm.productDescription.products_description_kh = data.elements[0].product_detail[1].products_description;
					vm.productDescription.products_name_en = data.elements[0].product_detail[0].products_name;
					vm.productDescription.products_name_kh = data.elements[0].product_detail[1].products_name;
					vm.optionalImage = data.elements[0].image_detail;
				});
			}else{
				vm.title = 'Create New Product';
			}
		};
		vm.init();
		// save functionality
		vm.save = function(){
			if (!$scope.form.$valid) {
				$anchorScroll();
				return;
			}
			// set object to save into news
			var data = {
				products: vm.product,
				products_description: [
					{
						products_name: vm.productDescription.products_name_en,
						products_description: vm.productDescription.products_description_en,
						language_id: 1,
					},
					{
						products_name: vm.productDescription.products_name_kh,
						products_description: vm.productDescription.products_description_kh,
						language_id: 2,
					}
				],
				products_image: vm.optionalImage
			};
			vm.loading = true;
			console.log(data);
			if($state.current.name == 'product.edit'){
				Restful.put("api/Product/" + $stateParams.id, data).success(function (data) {
					console.log(data);
					vm.service.alertMessage('<b>Complete: </b>Update Success.');
					$state.go('product');
				}).finally(function(){
					vm.loading = false;
				});
			}else{
				Restful.post("api/Product", data).success(function (data) {
					console.log(data);
					vm.service.alertMessage('<b>Complete: </b>Save Success.');
					$state.go('product');
				}).finally(function(){
					vm.loading = false;
				});
			}
		};

		vm.cancel = function(){
			window.history.back();
		};

		//functionality upload image
		vm.uploadPic = function(file, type) {
			// validate on if image option limit with 8 photo.
			if(type == 'optional') {
				if(vm.optionalImage.length >= 8){
					return vm.service.alertMessagePromt('<b>Warning: </b>We limit image upload only 8 photo.');
				}
			}
			if (file) {
				file.upload = Upload.upload({
					url: 'api/ImageUpload',
					data: {file: file, username: vm.username},
				});
				file.upload.then(function (response) {
					console.log(response);
					$timeout(function () {
						file.result = response.data;
						if(type == 'feature_image') {
							vm.product.products_image = response.data.image;
							vm.product.products_image_thumbnail = response.data.image_thumbnail;
						}
						if(type == 'optional') {
							var option = {
								image: response.data.image,
								image_thumbnail: response.data.image_thumbnail
							};
							vm.optionalImage.push(option);
						}
					});
				}, function (response) {
					if (response.status > 0)
						vm.errorMsg = response.status + ': ' + response.data;
				}, function (evt) {
					// Math.min is to fix I	E which reports 200% sometimes
					file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
				});
			}
		};

		// remove image
		vm.removeImage = function ($index) {
			vm.optionalImage.splice($index, 1);
		};
	}
]);
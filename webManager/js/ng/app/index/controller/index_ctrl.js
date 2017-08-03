app.controller(
	'index_ctrl', [
		'$scope'
		, 'Restful'
		, 'Services'
		, '$location'
		, function ($scope, Restful, Services, $location){
			var vm =this;
			Restful.get("api/Index").success(function(data){
				vm.index = data;
			});
			vm.gmtValue = 5.45;
			vm.startTimeValue = 1430990693334;
			vm.format = 'dd-MMM-yyyy hh:mm:ss a';
		}
	]);
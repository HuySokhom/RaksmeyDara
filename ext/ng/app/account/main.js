var app = angular.module(
	'main',
	[
	 	'ui.router'
		, 'ui.bootstrap'
		, 'ngSanitize'
		, 'ngFileUpload'
		, 'ngCookies'
		, 'ngAlertify'
		, 'angularjs-datetime-picker'
		, 'angularTrix'
	]
);
// range with number
app.filter('rangeNumber', function () {
	return function (input, total) {
		total = parseInt(total);
		for (var i = 1; i <= total; i++) {
			//if(i <= 9 ){

			//}
			input.push(i);
		}
		return input;
	};
});


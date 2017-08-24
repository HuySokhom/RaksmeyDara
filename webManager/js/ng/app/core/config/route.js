app.config([
	'$stateProvider',
	'$urlRouterProvider',
	'$locationProvider',
	function($stateProvider, $urlRouterProvider, $locationProvider) {
		var name = ' - SKWeb Solution';
		$stateProvider
			.state('dashboard', {
				url: '/dashboard',
				templateUrl: 'js/ng/app/index/partials/index.html',
				controller: 'index_ctrl as vm'
			})
			.state('content', {
				url: '/content',
				templateUrl: 'js/ng/app/content/partials/index.html',
				controller: 'content_ctrl as vm',
				data: { pageTitle: 'Content' + name}
			})
			.state('license', {
				url: '/license',
				templateUrl: 'js/ng/app/license/views/index.html',
				controller: 'license_ctrl as vm'
			})
			// .state('customer_expire', {
			// 	url: '/customer_expire',
			// 	templateUrl: 'js/ng/app/report_customer_expire/partials/index.html',
			// 	controller: 'report_customer_expire_ctrl as vm'
			// })
			// .state('customer_plan', {
			// 	url: '/customer_plan',
			// 	templateUrl: 'js/ng/app/customer_plan/partials/index.html',
			// 	controller: 'customer_plan_ctrl as vm'
			// })
			// .state('news', {
			// 	url: '/news',
			// 	templateUrl: 'js/ng/app/news/partials/news.html',
			// 	controller: 'news_ctrl as vm'
			// })
			// .state('news.post', {
			// 	url: '/news/post',
			// 	templateUrl: 'js/ng/app/news/partials/news_post.html',
			// 	controller: 'news_post_ctrl as vm'
			// })
			// .state('/news/edit/:id', {
			// 	url: '/news/edit/:id',
			// 	templateUrl: 'js/ng/app/news/partials/news_edit.html',
			// 	controller: 'news_edit_ctrl as vm'
			// })
			// .state('news_type', {
			// 	url: '/news_type',
			// 	templateUrl: 'js/ng/app/news/partials/type.html',
            //     controller: 'type_ctrl'
			// })
			// .state('news_type/edit:id', {
			// 	url: '/news_type/edit/:id',
			// 	templateUrl: 'js/ng/app/news/partials/type_edit.html',
			// 	controller: 'type_edit_ctrl as vm'
			// })
			// .state('news_type/post', {
			// 	url: '/news_type/post',
			// 	templateUrl: 'js/ng/app/news/partials/type_post.html',
			// 	controller: 'type_post_ctrl as vm'
			// })
			.state('slider', {
				url: '/slider',
				templateUrl: 'js/ng/app/image_slider/partials/index.php',
				controller: 'image_slider_ctrl as vm',
				data: { pageTitle: 'Image Slider' + name}
			})
			.state('user', {
				url: '/user',
				templateUrl: 'js/ng/app/user/partials/index.html',
				controller: 'user_ctrl as vm'
			})
			.state('/user/edit/:id', {
				url: '/user/edit/:id',
				templateUrl: 'js/ng/app/user/partials/user_edit.html',
				controller: 'user_edit_ctrl as vm'
			})
			// .state('/location', {
			// 	url: '/location',
			// 	templateUrl: 'js/ng/app/location/partials/location.html',
			// 	controller: 'location_ctrl as vm'
			// })
			// .state('/district', {
			// 	url: '/district',
			// 	templateUrl: 'js/ng/app/location/partials/district.html',
			// 	controller: 'district_ctrl as vm'
			// })
			// .state('/village', {
			// 	url: '/village',
			// 	templateUrl: 'js/ng/app/location/partials/village.html',
			// 	controller: 'village_ctrl as vm'
			// })
			/************************
			 * Start category route
			 ************************/
			.state('category', {
				url: '/category',
				template: '<div ui-view></div>',
				redirectTo: 'category.list'
			})
			.state('category.list', {
				url: '',
				templateUrl: 'js/ng/app/category/partials/index.html',
				controller: 'category_ctrl as vm',
				data: { pageTitle: 'Category' + name}
			})
			.state('category.create', {
				url: '/create',
				templateUrl: 'js/ng/app/category/partials/create.html',
				controller: 'category_create_ctrl as vm',
				data: { pageTitle: 'Create Category' + name}
			})			
			.state('category.edit', {
				url: '/edit/:id',
				templateUrl: 'js/ng/app/category/partials/create.html',
				controller: 'category_create_ctrl as vm',
				data: { pageTitle: 'Edit Category' + name}
			})
			/** End Category Route **/
			.state('product', {
				url: '/product',
				template: '<div ui-view></div>',
				redirectTo: 'product.list'
			})
			.state('product.list', {
				url: '',
				templateUrl: 'js/ng/app/product/partials/index.html',
				controller: 'product_ctrl as vm',
				data: { pageTitle: 'Product List' + name}
			})
			.state('product.create', {
				url: '/create',
				templateUrl: 'js/ng/app/product/partials/product_post.html',
				controller: 'product_post_ctrl as vm',
				data: { pageTitle: 'Create Product' + name}
			})
			.state('product.edit', {
				url: '/edit/:id',
				templateUrl: 'js/ng/app/product/partials/product_post.html',
				controller: 'product_post_ctrl as vm',
				data: { pageTitle: 'Edit Product' + name}
			})
			.state('/popular_location', {
				url: '/popular_location',
				templateUrl: 'js/ng/app/search_location/partials/index.html',
				controller: 'search_popular_ctrl as vm'
			})
			.state('social_media', {
				url: '/social_media',
				templateUrl: 'js/ng/app/social_media/partials/index.html',
				controller: 'social_media_ctrl as vm'
			})
			// .state('leason', {
            //     url: '/leason',
            //     template: '<div ui-view></div>',
            //     redirectTo: 'leason.list'
            // })
			// .state('leason.list', {
			// 	url: '',
			// 	templateUrl: 'js/ng/app/leason/partials/index.html',
			// 	controller: 'leason_ctrl as vm'
			// })
			// .state('leason.create', {
			// 	url: '/create',
			// 	templateUrl: 'js/ng/app/leason/partials/create.html',
			// 	controller: 'create_ctrl as vm'
			// })
			// .state('leason.edit', {
			// 	url: '/edit/:id',
			// 	templateUrl: 'js/ng/app/leason/partials/create.html',
			// 	controller: 'create_ctrl as vm'
			// })
			// .state('advertisement', {
			// 	url: '/advertisement',
			// 	templateUrl: 'js/ng/app/advertising_banner/partials/index.html',
			// 	controller: 'advertising_banner_ctrl as vm'
			// })
		;
		$urlRouterProvider.otherwise('dashboard');
		// use the HTML5 History API to remove # url
		// $locationProvider.html5Mode(true);
	}
]);

app.run(['$rootScope', '$state', function($rootScope, $state) {
    $rootScope.$on('$stateChangeStart', function(evt, to, params) {
      if (to.redirectTo) {
        evt.preventDefault();
        $state.go(to.redirectTo, params, {location: 'replace'})
      }
    });
}]);

/**
 * Directive Define title of the page
 */
app.directive('updateTitle', ['$rootScope', '$timeout',
  function($rootScope, $timeout) {
    return {
      link: function(scope, element) {

        var listener = function(event, toState) {

          var title = 'Default Title';
          if (toState.data && toState.data.pageTitle) title = toState.data.pageTitle;

          $timeout(function() {
            element.text(title);
          }, 0, false);
        };

        $rootScope.$on('$stateChangeSuccess', listener);
      }
    };
  }
]);
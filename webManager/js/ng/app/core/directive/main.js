app.directive('saveTemplate', function() {
    return {
        restrict: 'AE',
        scope: {
            cancel: '&',
            save: '&',
            disable: '='
        },
        require: ['?ngModel'],
        template:
            `<div class="ln_solid"></div>
           <a href="javascript:;" data-ng-click="cancel()" class="btn btn-primary">
                <i class="fa fa-times-circle"></i>
                Cancel
            </a>
            <button data-ng-click="save()" data-ng-disabled="disable" type="submit" class="btn btn-success">
                <i class="fa fa-save"></i>
                Save
            </button>`,
        link: function ($scope, element, attrs, ctrl) {
            //@todo
        }
    };
});
/**
 * Loading template for search page 
 */
app.directive('loading', function() {
    return {
        restrict: 'AE',
        scope: {
            loading: '='
        },
        require: ['?ngModel'],
        template:  `<img src="images/icons/gettestr-large-spinner-orange.gif"/>`,
        link: function ($scope, element, attrs, ctrl) {
            //@todo
        }
    };
});
/**
 * Directive record not found
 */
app.directive('emptyData', function() {
    return {
        restrict: 'AE',
        scope: {
            empty: '='
        },
        require: ['?ngModel'],
        template: `<div class="alert alert-warning">
                    <strong>Warning!</strong> Empty Data.
                </div>`,
        link: function ($scope, element, attrs, ctrl) {
            //@todo
        }
    };
});

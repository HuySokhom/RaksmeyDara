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
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button data-ng-click="cancel()" class="btn btn-primary">
                        <i class="fa fa-times-circle"></i>
                        Cancel
                    </button>
                    <button data-ng-click="save()" data-ng-disabled="disable" type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save
                    </button>
                </div>
            </div>`,
        link: function ($scope, element, attrs, ctrl) {
            //@todo
        }
    };
});

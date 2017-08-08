<div class="x_panel">
	<div class="x_title">
		<div class="row">
			<div class="form-inline col-md-7">
				Total Count: {{vm.totalItems}}
			</div>
			<ul class="nav navbar-right panel_toolbox">
				<li>
					<button class="btn btn-default pull-right" 
						data-toggle="modal" 
						data-target="#imagePopup"
						data-ng-click="vm.add();">
						<i class="fa fa-plus-circle"></i>
						Add New
					</button>
				</li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="5%">
						#
					</th>
					<th width="50%">
						Name
					</th>
					<th width="15%">
						Image
					</th>
					<th width="15%">
						Link
					</th>
					<th width="15%">
						Action
					</th>
				</tr>
			</thead>
			<tbody>
				<tr data-ng-if="!vm.image_sliders">
					<td colspan="4" align="center">
						<loading></loading>
					</td>
				</tr>
				<tr data-ng-if="vm.image_sliders.elements == 0">
					<td colspan="4" align="center">
						<empty-data></empty-data>
					</td>
				</tr>
				<tr data-ng-repeat="image_slider in vm.image_sliders.elements">
					<td>
						{{$index + 1}}
					</td>
					<td>
						<span data-ng-bind="image_slider.text"></span>
					</td>
					<td>
						<img src="../{{image_slider.image_thumbnail}}"
							data-ng-show="image_slider.image_thumbnail"/>
					</td>
					<td>
						<a href="{{image_slider.link}}" target="_blank">
							{{image_slider.link}}
						</a>
					</td>
					<td>
						<button class="btn btn-success btn-xs"
							data-ng-click="vm.updateStatus(image_slider);"
							data-ng-if="image_slider.status == 1"
							uib-tooltip="Active"
						>
							<span class="fa fa-check-square-o"></span>
						</button>
						<button class="btn btn-warning btn-xs"
							data-ng-if="image_slider.status == 0"
							data-ng-click="vm.updateStatus(image_slider);"
							uib-tooltip="Inactive"
						>
							<span class="fa fa-times-circle-o"></span>
						</button>
						<button class="btn btn-default btn-xs"
							data-ng-click="vm.edit(image_slider);"
							uib-tooltip="Edit"
						>
							<span class="fa fa-pencil-square-o"></span>
						</button>
						<button class="btn btn-danger btn-xs"
							data-ng-click="vm.remove($index, image_slider);"
							uib-tooltip="Delete"
						>
							<span class="fa fa-trash"></span>
						</button>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="panel-footer">
			<ul uib-pagination
				total-items="vm.totalItems"
				ng-model="vm.currentPage"
				ng-change="vm.pageChanged()"
				max-size="5"
				items-per-page="10"
				boundary-links="true"
			></ul>
		</div>
	</div>
</div>
<image:popup></image:popup>


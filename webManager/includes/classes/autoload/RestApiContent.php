<?php

use
	OSC\Content\Collection as ContentMasterCol,
	OSC\ContentDescription\Collection as ContentCol,
	OSC\ContentDescription\Object as ContentObj
;

class RestApiContent extends RestApi {

	public function get($params){
		$col = new ContentMasterCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);

	}

	public function put($params){
		$obj = new ContentObj();
		$id = $this->getId();
		$fields = $params['PUT'];
		foreach ( $fields as $k => $v){			
			$obj->setProperties($v);
			$obj->setPagesId($id);
			$obj->update();
			unset($v);
		}
		return array(
			'data' => array(
				'success' => 'true'
			)
		);

	}

}

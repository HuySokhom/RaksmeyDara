<?php

use
	OSC\SocialMedia\Collection as SocialMediaCol,
	OSC\SocialMedia\Object as SocialMediaObj
;

class RestApiSocialMedia extends RestApi {

	public function get($params){
		$col = new SocialMediaCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);

	}

	public function put($params){
		$obj = new SocialMediaObj();
		$id = $this->getId();
		$fields = $params['PUT'];
		$obj->setProperties($fields);
		$obj->setId($id);
		$obj->update();
		return array(
			'data' => array(
				'success' => 'true'
			)
		);

	}

}

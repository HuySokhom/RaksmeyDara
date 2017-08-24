<?php

use
	OSC\Product\Collection
		as ProductCol
;

class RestApiProducts extends RestApi {

	public function get($params){
		$showDataPerPage = 9;
		$start = $params['GET']['start'] ? $params['GET']['start'] : 0;
		$userId = $this->getId();
		$item_query = tep_db_query("
			select
				p.products_id,
				pd.products_name
			from
				products p, products_description pd
			where
				p.products_status = 1
					and
				p.products_id = pd.products_id
					and
				pd.language_id = " . $_SESSION['languages_id'] . "
					order by
				p.products_id desc
		");
		$array = array();
		while ($item = tep_db_fetch_array($item_query)){
			array_push($array,$item['products_name']);			
		}
		return array(
			data => array(
				elements => $array
			)
		);
//		$col = new ProductCol();
//
//		$col->filterByStatus(1);
//		$col->filterByLanguage($_SESSION['languages_id']);
//		$this->getId() ? $col->filterByCustomersId($this->getId()) : '';
//		$col->sortByDate("DESC");
//		// start limit page
//		$showDataPerPage = 9;
//		$start = $params['GET']['start'];
//		$this->applyLimit($col,
//			array(
//				'limit' => array( $start, $showDataPerPage )
//			)
//		);
//
//		$this->applySortBy($col, $params);
//		return $this->getReturn($col, $params);

	}

}

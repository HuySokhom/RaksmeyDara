<?php

namespace OSC\Categories;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('categories', 'c');
		$this->idField = 'c.categories_id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function sortByOrder($arg){
		$this->addOrderBy('c.sort_order', $arg);
	}

	public function filterByName($arg){
		$this->addTable('categories_description', 'cd');
		$this->addWhere("cd.categories_id = c.categories_id");
		$this->addWhere("cd.categories_name like "%' . $arg . '%" ");
	}

	public function filterById($arg){
		$this->addWhere("c.categories_id = " . $arg . " ");
	}
}

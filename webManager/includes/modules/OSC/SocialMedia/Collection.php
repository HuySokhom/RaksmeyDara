<?php

namespace OSC\SocialMedia;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('social_link', 'sl');
		$this->idField = 'sl.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		$this->addWhere("sl.id = '" . (int)$arg. "' ");
	}
	
	public function filterByName( $arg ){
		$this->addWhere("sl.name_en LIKE '%" . $arg. "%' ");
	}

}

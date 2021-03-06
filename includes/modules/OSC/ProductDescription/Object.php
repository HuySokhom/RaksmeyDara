<?php

namespace OSC\ProductDescription;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$productsId
		, $productsName
		, $productsDescription
		, $productsViewed
		, $languageId
		, $skill
		, $benefits
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'products_name',
				'products_description',
				'products_viewed',
				'benefits',
				'skill'
			)
		);
		return parent::toArray($args);
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				products_name,
				products_description,
				products_viewed,
				benefits,
				skill
			FROM
				products_description
			WHERE
				id = '" . (int)$this->getId() . "'
		");

		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Products Description not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

	}
	
	public function update() {
		if( !$this->getProductsId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				products_description
			SET 
				products_name = '" .  $this->dbEscape( $this->getProductsName() ). "',
				products_description = '" .  $this->dbEscape( $this->getProductsDescription() ). "',
				benefits = '" .  $this->dbEscape( $this->getBenefits() ). "',
				skill = '" .  $this->dbEscape( $this->getSkill() ). "'
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
					AND
				language_id = '" . (int)$this->getLanguageId() . "'
		");
	}

	public function delete(){
		if( !$this->getProductsId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				products_description
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				products_description
			(
				products_name,
				products_description,
				products_id,
				language_id,
				skill,
				benefits
			)
				VALUES
			(
 				'" . $this->dbEscape( $this->getProductsName() ) . "',
 				'" . $this->dbEscape( $this->getProductsDescription() ) . "',
				'" . $this->getProductsId() . "',
				'" . $this->getLanguageId() . "',
				'" . $this->getSkill() . "',
				'" . $this->getBenefits() . "'
			)
		");
	}
	public function setLanguageId( $string ){
		$this->languageId = (int)$string;
	}

	public function getLanguageId(){
		return $this->languageId;
	}

	public function setProductsName( $string ){
		$this->productsName = $string;
	}
	
	public function getProductsName(){
		return $this->productsName;
	}
	
	public function setProductsDescription( $string ){
		$this->productsDescription = $string;
	}
	
	public function getProductsDescription(){
		return $this->productsDescription;
	}

	public function setProductsViewed( $int ){
		$this->productsViewed = (int)$int;
	}

	public function getProductsViewed(){
		return $this->productsViewed;
	}
	
	public function setProductsId( $int ){
		$this->productsId = (int)$int;
	}
	
	public function getProductsId(){
		return $this->productsId;
	}

	public function setBenefits( $string ){
		$this->benefits = $string;
	}
	
	public function getBenefits(){
		return $this->benefits;
	}


	public function setSkill( $string ){
		$this->skill = $string;
	}
	
	public function getSkill(){
		return $this->skill;
	}

}

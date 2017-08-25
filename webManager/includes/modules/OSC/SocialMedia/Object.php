<?php

namespace OSC\SocialMedia;

use
	Aedea\Core\Database\StdObject as DbObj,
	OSC\Commune\Collection as DistrictCol
;

class Object extends DbObj {
		
	protected
		$title
		, $link
	;

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'title',
				'link'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				title,
				link
			FROM
				social_link
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Social Media Not Found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
	}

	public function update() {
		if( !$this->getId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				social_link
			SET
				title = '" .  $this->getTitle() . "',
				link = '" .  $this->getLink() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function delete(){
		if( !$this->getId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				social_link
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				social_link
			(
				title,
				link,
				create_date
			)
				VALUES
			(
				'" . $this->getTitle() . "',
				'" . $this->getLink() . "',
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setTitle( $string ){
		$this->title = (string)$string;
	}
	
	public function getTitle(){
		return $this->title;
	}

	public function setLink( $string ){
		$this->link = (string)$string;
	}

	public function getLink(){
		return $this->link;
	}

}

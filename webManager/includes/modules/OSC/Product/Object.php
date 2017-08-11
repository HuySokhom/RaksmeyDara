<?php

namespace OSC\Product;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\ProductDescription\Collection
			as ProductDescriptionCol
	, OSC\CustomerSample\Collection
		as CustomerCol
	, OSC\CategoriesDescription\Collection
		as CategoryCollection
	, OSC\ProductImage\Collection
		as ProductImageCol
;

class Object extends DbObj {
		
	protected
		$customersId
		, $productsId
		, $productsImage
		, $productsImageThumbnail
		, $productsPrice
		, $productsDateAdded
		, $productsStatus
		, $productsKindOf
		, $imageDetail
        , $productDetail
		, $categoriesId
		, $categoryDetail
		, $productsDiscount
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
                'id',
                'categories_id',
                'category_detail',
                'create_date',
				'products_price',
				'products_discount',
                'create_by',
                'products_status',
                'product_detail',
				'products_image',
				'products_image_thumbnail'
			)
		);
		return parent::toArray($args);
	}

	public function __construct( $params = array() ){
 		parent::__construct($params);
 		$this->productDetail = new ProductDescriptionCol();
		$this->categoryDetail = new CategoryCollection();
		$this->imageDetail = new ProductImageCol();
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				categories_id,
				products_date_added,
				products_status,
				products_price,
				products_discount,
				products_image,
				products_image_thumbnail,
				create_by
			FROM
				products
			WHERE
				products_id = '" . (int)$this->getId() . "'
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Products not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));
 		$this->productDetail->setFilter('id', $this->getId());
 		$this->productDetail->populate();

		$this->categoryDetail->setFilter('categories_id', $this->getCategoriesId());
		$this->categoryDetail->populate();
//
		$this->imageDetail->setFilter('products_id', $this->getId());
		$this->imageDetail->populate();
	}
	
	public function updateStatus() {
		if( !$this->getProductsId() ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				products
			SET 
				products_status = '" . (int)$this->getProductsStatus() . "'
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
	}

	public function delete(){
		if( !$this->getProductsId() ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				products
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");

		// remove products description
		$this->dbQuery("
			DELETE FROM
				products_description
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
		// remove products to categories
		$this->dbQuery("
			DELETE FROM
				products_to_categories
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
		// remove products image
		$this->dbQuery("
			DELETE FROM
				products_images
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
	}
	
	public function update(){
		$this->dbQuery("
			UPDATE
				products
			SET
				products_price = '" . (int)$this->getProductsPrice() . "',
				categories_id = '" . (int)$this->getCategoriesId() . "',
				products_discount = '" . $this->getProductsDiscount() . "',
 				products_image = '" . $this->getProductsImage() . "',
 				products_image_thumbnail = '" . $this->getProductsImageThumbnail() . "'
			WHERE
				products_id = '" . (int)$this->getProductsId() . "'
		");
		
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				products
			(
				categories_id,
				products_image,
				products_image_thumbnail,
				products_price,
				products_date_added,
				products_status,
				create_date,
				create_by,
				products_discount
			)
				VALUES
			(
				'" . (int)$this->getCategoriesId() . "',
 				'" . $this->dbEscape( $this->getProductsImage() ) . "',
 				'" . $this->dbEscape( $this->getProductsImageThumbnail() ) . "',
				'" . $this->getProductsPrice() . "',
 				NOW(),
 				1,
 				NOW(),
				 '" . $this->getCreateBy() . "',
				'" . $this->getProductsDiscount() . "'
			)
		");	
		$this->setProductsId( $this->dbInsertId() );
	}

	public function getProductsDiscount(){
		return $this->productsDiscount;
	}
	public function setProductsDiscount( $string ){
		$this->productsDiscount = doubleval($string);
	}
	
	public function setProductsId( $int ){
		$this->productsId = (int)$int;
	}
	
	public function getProductsId(){
		return $this->productsId;
	}
	
	public function setProductsDateAdded( $date ){
		$this->productsDateAdded = $date;
	}
	
	public function getProductsDateAdded(){
		return $this->productsDateAdded;
	}

	public function setProductsImageThumbnail( $string ){
		$this->productsImageThumbnail = (string)$string;
	}

	public function getProductsImageThumbnail(){
		return $this->productsImageThumbnail;
	}

	public function setProductsImage( $string ){
		$this->productsImage = (string)$string;
	}
	
	public function getProductsImage(){
		return $this->productsImage;
	}
	
	public function setProductsStatus( $int ){
		$this->productsStatus = (int)$int;
	}
	
	public function getProductsStatus(){
		return $this->productsStatus;
	}

	public function getImageDetail(){
		return $this->imageDetail;
	}
	public function setImageDetail( $array ){
		$this->imageDetail = $array;
	}

	public function getProductDetail(){
		return $this->productDetail;
	}
	public function setProductDetail( $array ){
		$this->productDetail = $array;
	}

	public function getProductsPrice(){
		return $this->productsPrice;
	}
	public function setProductsPrice( $int ){
		$this->productsPrice = doubleval($int);
	}

	public function getCategoriesId(){
		return $this->categoriesId;
	}
	public function setCategoriesId( $int ){
		$this->categoriesId = (int)$int;
	}

	public function getCategoryDetail(){
		return $this->categoryDetail;
	}
	public function setCategoryDetail( $array ){
		$this->categoryDetail = $array;
	}

}

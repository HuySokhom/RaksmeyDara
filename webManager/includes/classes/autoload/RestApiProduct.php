<?php

use
	OSC\Product\Collection
		as ProductPostCol
	, OSC\Product\Object
		as ProductPostObj
	, OSC\ProductToCategory\Object
		as ProductToCategoryObj
	, OSC\ProductDescription\Object
		as ProductDescriptionObj
	, OSC\ProductContactPerson\Object
		as ProductContactPersonObj
	, OSC\ProductImage\Object
		as ProductImageObj
;

class RestApiProduct extends RestApi {

	public function get($params){
		$col = new ProductPostCol();
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
		$params['GET']['search_title'] ? $col->filterByName($params['GET']['search_title']) : '';
		

		$params['GET']['category_id'] ? $col->filterByCategoryId($params['GET']['category_id']) : '';
		
		// start limit page
		$showDataPerPage = 10;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);
		$col->sortByDate('DESC');
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

	public function post($params){
		$productObject = new ProductPostObj();
		$productObject->setProperties($params['POST']['products']);
		$productObject->insert();
		$productId = $productObject->getProductsId();

		// save product to category
		$productToCategoryObject = new ProductToCategoryObj();
		$productToCategoryObject->setProductsId($productId);
		$productToCategoryObject->setCategoriesId($params['POST']['products']['categories_id']);
		$productToCategoryObject->insert();

		// save product images
		$productImageObject = new ProductImageObj();
		$fields = $params['POST']['products_image'];
		foreach ( $fields as $k => $v){
			$productImageObject->setProductsId($productId);
			$productImageObject->setProperties($v);
			$productImageObject->insert();
		}

		// save product description
		$fields = $params['POST']['products_description'];
		$productDetailObject = new ProductDescriptionObj();
		// $productDetailObject->setProductsId($productId);
		// $productDetailObject->setProperties($fields);
		// $productDetailObject->insert();
		foreach ( $fields as $k => $v){
			$productDetailObject->setProductsId($productId);
			$productDetailObject->setProperties($v);
			$productDetailObject->insert();
		}
		unset($params);
		return array(
			'data' => array(
				'id' => $productId
			)
		);
	}

	public function put($params){
		$cols = new ProductPostCol();
		$productId = $this->getId();
		$cols->filterById( $productId );
		if( $cols->getTotalCount() > 0 ){
			$cols->populate();
            $col = $cols->getFirstElement();
            $col->setProductsId($productId);
            $col->setProperties($params['PUT']['products']);
            $col->update();

            // update category to product
            $productToCategoryObject = new ProductToCategoryObj();
            $productToCategoryObject->setProductsId($productId);
            $productToCategoryObject->setCategoriesId($params['PUT']['products']['categories_id']);
            $productToCategoryObject->update();

            // save product description
            $fields = $params['PUT']['products_description'];
            $productDetailObject = new ProductDescriptionObj();
			// $productDetailObject->setProductsId($productId);
			// $productDetailObject->setProperties($fields);
			// $productDetailObject->update();
            foreach ( $fields as $k => $v){
                $productDetailObject->setProductsId($productId);
                $productDetailObject->setProperties($v);
                $productDetailObject->update();
                unset($v);
            }

			// save product images
			$productImageObject = new ProductImageObj();
			$productImageObject->setProductsId($productId);
			$productImageObject->delete();
			$fields = $params['PUT']['products_image'];
			foreach ( $fields as $k => $v){
				$productImageObject->setProductsId($productId);
				$productImageObject->setProperties($v);
				$productImageObject->insert();
			}

            return array(
				'data' => array(
					'data' => 'update success'
				)
			);
		}
	}

	public function patch($params){
		$cols = new ProductPostCol();
		$cols->filterById( $this->getId() );
		if( $cols->getTotalCount() > 0 ){
			$cols->populate();
			$col = $cols->getFirstElement();
			$col->setProductsId($this->getId());
			if( $params['PATCH']['name'] == "update_status"){
				$col->setProductsStatus($params['PATCH']['status']);
				$col->updateStatus();
			}else{
				$col->refreshDate();
			}
		}
		return array(
			'data' => array(
				'data' => 'update success'
			)
		);

	}
	public function delete(){
		$cols = new ProductPostCol();
		$cols->filterById( $this->getId() );
		if( $cols->getTotalCount() > 0 ){
			$cols->populate();
			$col = $cols->getFirstElement();
			$col->setProductsId($this->getId());
			$col->delete();
		}
		return array(
			'data' => array(
				'data' => 'success'
			)
		);

	}

}


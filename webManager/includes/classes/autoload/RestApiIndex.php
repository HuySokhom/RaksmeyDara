<?php

class RestApiIndex extends RestApi {

	public function get(){
		$products_query = tep_db_query("select count(products_id) as total from products where products_status = 1");
		$products = tep_db_fetch_array($products_query);

		$customer_query = tep_db_query("select count(customers_id) as total from customers where status = 1");
		$customer = tep_db_fetch_array($customer_query);

		$category_query = tep_db_query("select count(categories_id) as total from categories");
		$category = tep_db_fetch_array($category_query);


		return array( data =>
			array(
				total_products => $products['total'],
				total_customers => $customer['total'],
				total_categories => $category['total'],
			)
		);
	}
}

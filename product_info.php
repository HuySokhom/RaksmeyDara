<?php
	require('includes/application_top.php');

	if (!isset($HTTP_GET_VARS['products_id'])) {
	tep_redirect(tep_href_link(FILENAME_DEFAULT));
	}

	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

	require(DIR_WS_INCLUDES . 'template_top.php');
	$product_info_query = tep_db_query("
		select
			p.products_id,
			p.products_price,
			p.products_discount,
			p.products_price - (p.products_price * p.products_discount / 100) as products_latest_price,
			pd.products_name,
			pd.products_description,			
			pd.products_viewed
		from
			" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
		where
			p.products_status = 1
				and
			p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'
				and
			pd.products_id = p.products_id
				and
			pd.language_id = '" . (int)$languages_id . "'
	");
	$product_info = tep_db_fetch_array($product_info_query);

	// query hot jobs
	$hot_product_query = tep_db_query("
		select
			p.products_id,
			p.customers_id,
			pd.products_name
		from
			" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
		where
			p.products_status = '1'				
				and
			p.products_id != '".(int)$_GET['products_id'] ."'
				and
			pd.products_id = p.products_id
				and
			pd.language_id = '" . (int)$languages_id . "'
		order by
        	p.products_id 
		limit 15
	");
	$array_hot = array();
	while( $product_hot_info = tep_db_fetch_array($hot_product_query) ){
		$array_hot[] = $product_hot_info ;
	}

?>
<?php
  if (tep_db_num_rows($product_info_query) < 1) {
?>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="alert alert-warning"><?php echo TEXT_PRODUCT_NOT_FOUND; ?></div>
		<div class="pull-right">
			<?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-mail-forward', tep_href_link(FILENAME_DEFAULT)); ?>
		</div>
	</div>
	<br>
	<br>
	<br>
<?php
  } else {
    tep_db_query("
        UPDATE
            " . TABLE_PRODUCTS_DESCRIPTION . "
        SET
            products_viewed = products_viewed+1
        WHERE
            products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'
    ");

?>

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li><a href="products.html">Products</a></li>
          <li class="active">
		  	<?php 
				echo $product_info['products_name'];
			?>
		  </li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Image List -->
        <div class="col-sm-4">
          <div class="image-detail">
            <img src="images/demo/p1-1.jpg" data-zoom-image="images/demo/p1-large-1.jpg" alt="">
          </div>
          <div class="products-slider-detail owl-carousel owl-theme m-b-2">
            <a href="detail.html#"><img src="images/demo/p1-1.jpg" data-zoom-image="images/demo/p1-large-1.jpg" alt="" class="img-thumbnail"></a>
            <a href="detail.html#"><img src="images/demo/p1-2.jpg" data-zoom-image="images/demo/p1-large-2.jpg" alt="" class="img-thumbnail"></a>
            <a href="detail.html#"><img src="images/demo/p1-3.jpg" data-zoom-image="images/demo/p1-large-3.jpg" alt="" class="img-thumbnail"></a>
            <a href="detail.html#"><img src="images/demo/p1-4.jpg" data-zoom-image="images/demo/p1-large-4.jpg" alt="" class="img-thumbnail"></a>
            <a href="detail.html#"><img src="images/demo/p1-1.jpg" data-zoom-image="images/demo/p1-large-1.jpg" alt="" class="img-thumbnail"></a>
          </div>
          <div class="title"><span>Share to</span></div>
          <div class="share-button m-b-3">
            <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
            <button type="button" class="btn btn-info"><i class="fa fa-twitter"></i></button>
            <button type="button" class="btn btn-danger"><i class="fa fa-google-plus"></i></button>
            <button type="button" class="btn btn-primary"><i class="fa fa-linkedin"></i></button>
            <button type="button" class="btn btn-warning"><i class="fa fa-envelope"></i></button>
          </div>
        </div>
        <!-- End Image List -->

        <div class="col-sm-8">
			<div class="title-detail">
		  		<?php 
					echo $product_info['products_name'];  
				?>
			</div>
          <table class="table table-detail">
            <tbody>
              <tr>
                <td>Price</td>
                <td>
                  <div class="price">
                    <div>
						<?php echo $currencies->display_price($product_info['products_latest_price'], 0);?> 
						<span class="label label-default arrowed">
							<?php echo doubleval($product_info['products_discount']); ?>%
						</span>
					</div>
                    <span class="price-old"><?php echo $currencies->display_price($product_info['products_price'], 0);?></span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Availability</td>
                <td><span class="label label-success arrowed">Ready Stock</span></td>
              </tr>
              <tr></tr>
                <td>View</td>
                <td>
					<span class="label label-warning arrowed">
						<?php echo $product_info['products_viewed'];?>
					</span>
				</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-8">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
				<a href="#desc" aria-controls="desc" role="tab" data-toggle="tab">
					Description
				</a>
			</li>
          </ul>
          <!-- End Nav tabs -->

          <!-- Tab panes -->
          <div class="tab-content tab-content-detail">

              <!-- Description Tab Content -->
              <div role="tabpanel" class="tab-pane active" id="desc">
                <div class="well">
                  <?php 
				  	echo $product_info['products_description'];
				  ?>
                </div>
              </div>
              <!-- End Description Tab Content -->
          </div>
          <!-- End Tab panes -->

        </div>
      </div>

      <!-- Related Products -->
      <div class="row m-t-3">
        <div class="col-xs-12">
          <div class="title"><span>Related Products</span></div>
          <div class="related-product-slider owl-carousel owl-theme owl-controls-top-offset">
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p1-1.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-default arrowed">Featured</span></span>
                  </div>
                  <div class="tags tags-left">
                    <span class="label-tags"><span class="label label-danger arrowed-right">Sale</span></span>
                  </div>
                  <div class="option">
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">WranglerGrey Printed Slim Fit Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-default">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <a href="detail.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p2-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><span class="label label-success arrowed-right">New Arrivals</span></span>
                  </div>
                  <div class="option">
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">CelioKhaki Printed Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-primary">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <a href="detail.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p3-1.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-danger arrowed">Sale</span></span>
                    <span class="label-tags"><span class="label label-info arrowed">Collection</span></span>
                  </div>
                  <div class="option">
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">CelioOff White Printed Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-success">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <a href="detail.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p4-1.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-primary arrowed">Popular</span></span>
                  </div>
                  <div class="option">
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">Levi'sNavy Blue Printed Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-danger">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <a href="detail.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p5-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><span class="label label-primary arrowed-right">Pupolar</span></span>
                  </div>
                  <div class="option">
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">IncultAcid Wash Raglan Crew Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-danger arrowed">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <a href="detail.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p6-1.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-danger arrowed">Hot Item</span></span>
                  </div>
                  <div class="option">
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">Avoir EnvieOlive Printed Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-success arrowed">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <a href="detail.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/vneck1.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-danger arrowed">Sale</span></span>
                    <span class="label-tags"><span class="label label-default arrowed">Collection</span></span>
                  </div>
                  <div class="option">
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="detail.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">PhosphorusGrey Melange Printed V Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-danger arrowed">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <i class="fa fa-star-o"></i>
                  <a href="detail.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Related Products -->

    </div>
    <!-- End Main Content -->
<?php
  }
?>


<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
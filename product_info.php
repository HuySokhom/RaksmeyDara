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
      p.products_image,
      p.products_quantity,
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

  // query product image
  $image_query = tep_db_query("
		select
			image,
			image_thumbnail
		from
			products_images
		where
      products_id = ".(int)$_GET['products_id'] ."
	");
	$imageList = array();
	while( $image_info = tep_db_fetch_array($image_query) ){
		$imageList[] = $image_info;
	}
  
	// query product_relate_info
	$relate_product_query = tep_db_query("
		select
			p.products_id,
			p.products_price,
      p.products_discount,
      p.products_quantity,
      p.products_image_thumbnail,
			p.products_price - (p.products_price * p.products_discount / 100) as products_latest_price,
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
        and
	  	p.categories_id = '" . (int)$current_category_id . "'
		order by
      p.products_id 
		limit 10
	");
	$relatePost = array();
	while( $product_relate_info = tep_db_fetch_array($relate_product_query) ){
		$relatePost[] = $product_relate_info ;
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
          <li>
            <a href="index.html">
              <?php 
                echo TEXT_HOME;
              ?>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <?php 
                echo TEXT_PRODUCTS;
              ?>
            </a>
          </li>
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
            <img src="<?php echo $product_info['products_image']; ?>" data-zoom-image="<?php echo $product_info['products_image']; ?>" alt="">
          </div>
          <div class="products-slider-detail owl-carousel owl-theme m-b-2">
            <?php 
                foreach ($imageList as $image) {
                    echo '<a href="#"><img src="'.$image['image_thumbnail'].'" 
                      data-zoom-image="'.$image['image'].'" alt="" class="img-thumbnail"></a>';
                }
            ?>
          </div>
          <div class="title"><span><?php echo TEXT_SHARE_TO;?></span></div>
          <div class="share-button m-b-3">
            <!-- <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
            <button type="button" class="btn btn-info"><i class="fa fa-twitter"></i></button>
            <button type="button" class="btn btn-danger"><i class="fa fa-google-plus"></i></button>
            <button type="button" class="btn btn-primary"><i class="fa fa-linkedin"></i></button>
            <button type="button" class="btn btn-warning"><i class="fa fa-envelope"></i></button> -->
            
            <!-- Go to www.addthis.com/dashboard to customize your tools --> 
            <div class="addthis_inline_share_toolbox_07k1"></div>
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
                <td><?php echo TEXT_PRICE;?></td>
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
                <td><?php echo TEXT_AVAILABILITY;?></td>
                <td>
                    <?php 
                    if((int)$product_info['products_quantity'] > 0){
                        echo '
                          <span class="label label-success arrowed">
                          '. TEXT_IN_STOCK .'
                        </span>
                        ';
                    }else{
                        echo '
                          <span class="label label-danger arrowed">
                          '. TEXT_OUT_OF_STOCK .'
                          </span>
                        ';
                    } ?>
                    
                </td>
              </tr>
              <tr>
                <td><?php echo TEXT_VIEWED;?></td>
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
          <?php echo TEXT_DESCRIPTION;?>
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
        
        <div class="title"><span><?php echo TEXT_RELATE_PRODUCTS; ?></span></div>
        <?php                 
            if(count($relatePost) > 0){
        ?>
          <div class="related-product-slider owl-carousel owl-theme owl-controls-top-offset">
            <?php 
                foreach ($relatePost as $product) {
                    echo '
                      <div class="box-product-outer">
                        <div class="box-product">
                          <div class="img-wrapper">
                            <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['products_id']) . '">
                                <img alt="Product" src="' . $product['products_image_thumbnail'] . '">
                            </a>
                          </div>
                          <h6>
                            <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['products_id']) . '">
                              ' . $product['products_name'] . '
                            </a>
                          </h6>
                          <div class="price">
                              <div>
                                  '. $currencies->display_price($product['products_latest_price'], 0) .'
                                  <span class="label-tags">
                                  <span class="label label-danger"> '. doubleval($product['products_discount']) .'%</span>
                                  </span>
                              </div>
                              <span class="price-old"> '. $currencies->display_price($product['products_price'], 0) .'</span>
                          </div>
                        </div>
                      </div>
                      ';
                }
              
            ?>
          </div>
          
      <?php       
        }else{
          echo '<div class="col-md-12 alert alert-info"> ' . TEXT_NO_PRODUCT_FOUND . '</div>';
        }
      ?>
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
<script src="assets/js/mimity.detail.js"></script>
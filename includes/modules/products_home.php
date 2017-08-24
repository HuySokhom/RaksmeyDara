<?php
    /**
    * Start Query for image slider
    ***/
    $image_query = tep_db_query("
        select * from image_slider
        where status = 1
        order by sort_order asc limit 10"
    );
    $num_image = tep_db_num_rows($image_query);
    $array_image = array();
    if($num_image > 0) {
        while ($images = tep_db_fetch_array($image_query)) {
            $array_image[] = $images;
        }
    }

    // get categories to display product by categories and with parent id 0
    $category_query = tep_db_query("
        select c.categories_id, cd.categories_name 
        from categories c,  categories_description cd
        where c.parent_id = 0 and c.categories_id = cd.categories_id and cd.language_id = " . (int)$languages_id . ""
    );
    $num_categories = tep_db_num_rows($category_query);
    $result_categories = array();
    if($num_categories > 0) {
        while ($item = tep_db_fetch_array($category_query)) {
            $result_categories[] = $item;
        }
    }

?>



    <!-- Full Slider -->
    <div class="container-fluid">
      <div class="row">
        <div class="owl-carousel owl-theme home-slider">
          <?php 
            foreach ($array_image as $value) {
                echo ' <div class="item">
                  <a href=""><img src="'. $value['image'] .'" alt="Slider"></a>
                </div>';
            }
          ?>
        </div>
      </div>
    </div>
    <!-- End Full Slider -->
    <!-- Main Content -->
    <div class="container m-t-2">
      <div class="row">
          <?php 
              foreach($result_categories as $value){
                
                // Query Product
                $new_products_query = tep_db_query("
                  select
                    p.products_id,
                    p.products_image_thumbnail,
                    pd.products_name,
                    p.products_price,
                    p.products_discount,
                    p.products_price - (p.products_price * p.products_discount / 100) as products_latest_price
                  from
                    " . TABLE_PRODUCTS . " p,
                    " . TABLE_PRODUCTS_DESCRIPTION . " pd
                  where
                    p.categories_id = ". $value['categories_id'] ."
                        and 
                    p.products_status = 1
                        and
                    p.products_id = pd.products_id
                        and
                    pd.language_id = '" . (int)$languages_id . "'
                        order by
                    p.products_id desc
                    limit " . MAX_DISPLAY_NEW_PRODUCTS
                );
                $num_new_products = tep_db_num_rows($new_products_query);
                $product_array = array();
                if ($num_new_products > 0) {
                    echo '                  
                        <div class="col-md-12">
                        <!-- Featured -->
                        <div class="title"><span>'. $value['categories_name'] .'</span></div>
                        <div class="product-slider owl-carousel owl-theme owl-controls-top-offset">
                      ';
                    while ($new_products = tep_db_fetch_array($new_products_query)) {
                        echo ' 
                          <div class="box-product-outer">
                            <div class="box-product">
                              <div class="img-wrapper">
                                <a href="'. tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . $setLanguage .'">
                                  <img alt="'. $new_products['products_name'] .'" src="'. $new_products['products_image_thumbnail'] .'">
                                </a>
                              </div>
                              <h6>
                                <a href="'. tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . $setLanguage . '">
                                  '. $new_products['products_name'] .'
                                </a>
                              </h6>
                              <div class="price">
                                <div>
                                  '. $currencies->display_price($new_products['products_latest_price'], 0) .'
                                  <span class="label-tags">
                                    <span class="label label-danger"> '. doubleval($new_products['products_discount']) .'%</span>
                                  </span>
                                  </div>
                                <span class="price-old"> '. $currencies->display_price($new_products['products_price'], 0) .'</span>
                              </div>
                            </div>
                          </div>
                        ';
                    }
                        
                    echo '<!-- End Featured -->
                        </div>
                      </div>'
                    ;
                }
              }
              
              
          ?>
          

      <!-- Brand & Clients -->
      <!-- <div class="row">
        <div class="col-xs-12 m-t-1">
          <div class="title"><span>Brand & Clients</span></div>
          <div class="brand-slider owl-carousel owl-theme owl-controls-top-offset">
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand1.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand2.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand3.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand4.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand5.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand1.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand2.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand3.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand4.png" alt=""></a>
            </div>
            <div class="brand">
              <a href="index.html"><img src="images/demo/brand5.png" alt=""></a>
            </div>
          </div>
        </div>
      </div> -->
      <!-- End Brand & Clients -->

    </div>
    <!-- End Main Content -->
</div>
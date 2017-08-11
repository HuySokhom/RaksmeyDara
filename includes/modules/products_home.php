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
        p.products_status = 1
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
        while ($new_products = tep_db_fetch_array($new_products_query)) {
            $product_array[] = $new_products;
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
                  <a href="" class="hidden-xs"><img src="'. $value['image'] .'" alt="Slider"></a>
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
        <div class="col-md-12">

          <!-- Featured -->
          <div class="title"><span>Featured Products</span></div>
          <?php /*
              foreach ($product_array as $product) {
                  echo ' 
                    <div class="col-xs-6 col-sm-4 col-lg-3 box-product-outer">
                      <div class="box-product">
                        <div class="img-wrapper">
                          <a href="'. tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['products_id']) .'">
                            <img alt="'. $product['products_name'] .'" src="'. $product['products_image_thumbnail'] .'">
                          </a>
                        </div>
                        <h6>
                          <a href="'. tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['products_id']) .'">
                            '. $product['products_name'] .'
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
              }*/
          ?>
          <div class="col-xs-6 col-sm-4 col-lg-3 box-product-outer">
            <div class="box-product">
              <div class="img-wrapper">
                <a href="detail.html">
                  <img alt="Product" src="images/demo/polo1.jpg">
                </a>
              </div>
              <h6><a href="detail.html">IncultGeo Print Polo T-Shirt</a></h6>
              <div class="price">
                <div>$13.50 <span class="label-tags"><span class="label label-danger">-10%</span></span></div>
                <span class="price-old">$15.00</span>
              </div>
            </div>
          </div>

          <div class="col-xs-6 col-sm-4 col-lg-3 box-product-outer">
            <div class="box-product">
              <div class="img-wrapper">
                <a href="detail.html">
                  <img alt="Product" src="images/demo/polo2.jpg">
                </a>
                <div class="tags">
                  <span class="label-tags"><span class="label label-default arrowed">Featured</span></span>
                </div>
                <div class="tags tags-left">
                  <span class="label-tags"><span class="label label-success arrowed-right">Sale</span></span>
                </div>
                <div class="option">
                  <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                </div>
              </div>
              <h6><a href="detail.html">Tommy HilfigerNavy Blue Printed Polo T-Shirt</a></h6>
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
                <a href="index.html#">(5 reviews)</a>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-4 col-lg-3 box-product-outer">
            <div class="box-product">
              <div class="img-wrapper">
                <a href="detail.html">
                  <img alt="Product" src="images/demo/polo3.jpg">
                </a>
                <div class="tags">
                  <span class="label-tags"><span class="label label-default arrowed">Featured</span></span>
                </div>
                <div class="tags tags-left">
                  <span class="label-tags"><span class="label label-primary arrowed-right">Sale</span></span>
                </div>
                <div class="option">
                  <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                </div>
              </div>
              <h6><a href="detail.html">WranglerNavy Blue Solid Polo T-Shirt</a></h6>
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
                <a href="index.html#">(5 reviews)</a>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-4 col-lg-3 visible-xs visible-lg box-product-outer">
            <div class="box-product">
              <div class="img-wrapper">
                <a href="detail.html">
                  <img alt="Product" src="images/demo/polo4.jpg">
                </a>
                <div class="tags">
                  <span class="label-tags"><span class="label label-default arrowed">Featured</span></span>
                </div>
                <div class="tags tags-left">
                  <span class="label-tags"><span class="label label-danger arrowed-right">Sale</span></span>
                </div>
                <div class="option">
                  <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                </div>
              </div>
              <h6><a href="detail.html">NikeAs Matchup -Pq Grey Polo T-Shirt</a></h6>
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
                <a href="index.html#">(5 reviews)</a>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-4 col-lg-3 visible-xs visible-lg box-product-outer">
            <div class="box-product">
              <div class="img-wrapper">
                <a href="detail.html">
                  <img alt="Product" src="images/demo/polo4.jpg">
                </a>
                <div class="tags">
                  <span class="label-tags"><span class="label label-default arrowed">Featured</span></span>
                </div>
                <div class="tags tags-left">
                  <span class="label-tags"><span class="label label-danger arrowed-right">Sale</span></span>
                </div>
                <div class="option">
                  <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                </div>
              </div>
              <h6><a href="detail.html">NikeAs Matchup -Pq Grey Polo T-Shirt</a></h6>
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
                <a href="index.html#">(5 reviews)</a>
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-4 col-lg-3 visible-xs visible-lg box-product-outer">
            <div class="box-product">
              <div class="img-wrapper">
                <a href="detail.html">
                  <img alt="Product" src="images/demo/polo4.jpg">
                </a>
                <div class="tags">
                  <span class="label-tags"><span class="label label-default arrowed">Featured</span></span>
                </div>
                <div class="tags tags-left">
                  <span class="label-tags"><span class="label label-danger arrowed-right">Sale</span></span>
                </div>
                <div class="option">
                  <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                  <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                </div>
              </div>
              <h6><a href="detail.html">NikeAs Matchup -Pq Grey Polo T-Shirt</a></h6>
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
                <a href="index.html#">(5 reviews)</a>
              </div>
            </div>
          </div>
          <!-- End Featured -->
        </div>

      </div>

      <!-- Brand & Clients -->
      <div class="row">
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
      </div>
      <!-- End Brand & Clients -->

    </div>
    <!-- End Main Content -->

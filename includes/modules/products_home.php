<?php
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

    // query featured company
    $feature_query = tep_db_query("
        select
            customers_id,
            photo_thumbnail
        from
            customers
        where
            status = 1
              and
            user_type = 'agency'
              and
            is_agency = 1
              and
            status_approve = 1
              and
            is_publish = 1
        order by rand()           
    ");
    $num_featured = tep_db_num_rows($feature_query);
    $array_featured_company = [];
    if($num_featured > 0) {
        while ($featured = tep_db_fetch_array($feature_query)) {
            $array_featured_company[] = $featured;
        }
    }

    // query job
    $new_products_query = tep_db_query("
      select
        p.products_id,
        p.create_date,
        pd.products_name,
        DATE_FORMAT(p.products_close_date, '%d/%m/%Y') as products_close_date,
        cu.photo_thumbnail,
        cu.company_name,
        l.name as location
      from
        " . TABLE_PRODUCTS . " p,
        customers cu,
        location l,
        " . TABLE_PRODUCTS_DESCRIPTION . " pd
      where
        p.products_status = 1
            and 
        p.is_publish = 1
            and
        l.id = p.province_id
            and
        p.products_id = pd.products_id
            and
        cu.customers_id = p.customers_id
            and
        pd.language_id = '" . (int)$languages_id . "'
            order by
        p.products_id desc, p.products_close_date desc
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
        <!-- New Arrivals & Best Selling -->
        <div class="col-md-3 m-b-1">
          <div class="title"><span><a href="products.html">New Arrivals <i class="fa fa-chevron-circle-right"></i></a></span></div>
          <div class="widget-slider owl-carousel owl-theme owl-controls-top-offset m-b-2">
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p1-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><a href="products.html"><span class="label label-success arrowed-right">New Arrivals</span></a></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">WranglerGrey Printed Slim Fit Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$15.00</div>
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
                    <span class="label-tags"><a href="products.html"><span class="label label-success arrowed-right">New Arrivals</span></a></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">CelioKhaki Printed Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$15.00</div>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p3-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><a href="products.html"><span class="label label-success arrowed-right">New Arrivals</span></a></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">CelioOff White Printed Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$15.00</div>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p4-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><a href="products.html"><span class="label label-success arrowed-right">New Arrivals</span></a></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">Levi'sNavy Blue Printed Round Neck T-Shirt</a></h6>
                <div class="price">
                  <div>$15.00</div>
                </div>
              </div>
            </div>
          </div>
          <div class="title"><span><a href="products.html">Best Selling <i class="fa fa-chevron-circle-right"></i></a></span></div>
          <div class="widget-slider owl-carousel owl-theme owl-controls-top-offset">
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p5-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><span class="label label-primary arrowed-right">Popular</span></span>
                    <span class="label-tags"><span class="label label-default arrowed-right">Top Week</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
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
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p6-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><span class="label label-primary arrowed-right">Popular</span></span>
                    <span class="label-tags"><span class="label label-default arrowed-right">Top Week</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">Avoir EnvieOlive Printed Round Neck T-Shirt</a></h6>
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
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p7-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><span class="label label-primary arrowed-right">Popular</span></span>
                    <span class="label-tags"><span class="label label-default arrowed-right">Top Week</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">ElaboradoBrown Printed Round Neck T-Shirt</a></h6>
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
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/p4-1.jpg">
                  </a>
                  <div class="tags tags-left">
                    <span class="label-tags"><span class="label label-primary arrowed-right">Popular</span></span>
                    <span class="label-tags"><span class="label label-default arrowed-right">Top Week</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">Levi'sNavy Blue Printed Round Neck T-Shirt</a></h6>
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
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End New Arrivals & Best Selling -->

        <div class="clearfix visible-sm visible-xs"></div>

        <div class="col-md-9">

          <!-- Featured -->
          <div class="title"><span>Featured Products</span></div>
          <div class="col-xs-6 col-sm-4 col-lg-3 box-product-outer">
            <div class="box-product">
              <div class="img-wrapper">
                <a href="detail.html">
                  <img alt="Product" src="images/demo/polo1.jpg">
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
              <h6><a href="detail.html">IncultGeo Print Polo T-Shirt</a></h6>
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
                <a href="index.html#">(5 reviews)</a>
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
          <!-- End Featured -->

          <div class="clearfix visible-sm visible-xs"></div>

          <!-- Collection -->
          <div class="title m-t-2"><span>V-Neck Collection</span></div>
          <div class="product-slider owl-carousel owl-theme owl-controls-top-offset">
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
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
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
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/vneck2.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-danger arrowed">Sale</span></span>
                    <span class="label-tags"><span class="label label-primary arrowed">Collection</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">United Colors of BenettonNavy Blue Solid V Neck T Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-success arrowed">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <i class="fa fa-star-o"></i>
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/vneck3.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-danger arrowed">Sale</span></span>
                    <span class="label-tags"><span class="label label-success arrowed">Collection</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">WranglerBlack V Neck T Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-primary arrowed">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <i class="fa fa-star-o"></i>
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/vneck4.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-danger arrowed">Sale</span></span>
                    <span class="label-tags"><span class="label label-info arrowed">Collection</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">Tagd New YorkGrey Printed V Neck T-Shirts</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-default arrowed">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <i class="fa fa-star-o"></i>
                  <a href="index.html#">(5 reviews)</a>
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
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
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
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
            <div class="box-product-outer">
              <div class="box-product">
                <div class="img-wrapper">
                  <a href="detail.html">
                    <img alt="Product" src="images/demo/vneck2.jpg">
                  </a>
                  <div class="tags">
                    <span class="label-tags"><span class="label label-danger arrowed">Sale</span></span>
                    <span class="label-tags"><span class="label label-primary arrowed">Collection</span></span>
                  </div>
                  <div class="option">
                    <a href="index.html#" data-toggle="tooltip" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-align-left"></i></a>
                    <a href="index.html#" data-toggle="tooltip" title="Add to Wishlist" class="wishlist"><i class="fa fa-heart"></i></a>
                  </div>
                </div>
                <h6><a href="detail.html">United Colors of BenettonNavy Blue Solid V Neck T Shirt</a></h6>
                <div class="price">
                  <div>$13.50 <span class="label-tags"><span class="label label-success arrowed">-10%</span></span></div>
                  <span class="price-old">$15.00</span>
                </div>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-o"></i>
                  <i class="fa fa-star-o"></i>
                  <a href="index.html#">(5 reviews)</a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Collection -->

        </div>

      </div>

      <!-- Brand & Clients -->
      <div class="row">
        <div class="col-xs-12 m-t-1">
          <div class="title text-center"><span>Brand & Clients</span></div>
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

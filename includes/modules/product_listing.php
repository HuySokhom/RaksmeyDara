<?php
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');
?>

<?php
  if ($messageStack->size('product_action') > 0) {
    echo $messageStack->output('product_action');
  }
?>
<?php
  $row = $listing_split->number_of_rows;
  if ($row > 0) {
      $listing_query = tep_db_query($listing_split->sql_query);
      $prod_list_contents = array();
      while ($listing = tep_db_fetch_array($listing_query)) {
          switch ($listing['products_promote']) {
              case 3:
                  $text = 'Pro';
                  $class = 'pro';
                  break;
              case 2:
                  $text = 'Premium';
                  $class = 'pro';
                  break;
              case 1:
                  $text = 'Basic';
                  $class = 'pro';
                  break;
              default:
                  $text = 'Free';
                  $class = 'free';
          }
          $prod_list_contents[] = $listing;
      }
  }
?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                if($row > 0) {
                  echo ' <div class="title">
                            <span>'.TEXT_PRODUCTS.'</span>
                        </div>';
                  foreach ($prod_list_contents as $product) {
                    echo ' <div class="col-xs-6 col-sm-4 col-lg-3 box-product-outer">
                            <div class="box-product">
                                <div class="img-wrapper">
                                    <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['products_id']) . $setLanguage .'">
                                        <img alt="Product" src="' . $product['products_image_thumbnail'] . '">
                                    </a>
                                </div>
                                <h6>
                                    <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['products_id']) . $setLanguage .'">
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
                <!-- /.product-list -->
                <div class="text-center">
                    <br>
                    <ul class="pagination">
                        <?php
                        echo $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS,
                            tep_get_all_get_params(array('page', 'info', 'x', 'y'))
                        );
                        ?>
                    </ul>
                </div><!-- /.center -->
              <?php
              } else {
              ?>
                  <div class="col-md-12">
                      <div class="alert alert-info"><?php echo TEXT_NO_PRODUCTS; ?></div>
                  </div>
                  <?php
              }
              ?>
              </div><!-- /.col-* -->
          </div><!-- /.row -->
      </div><!-- /.container -->

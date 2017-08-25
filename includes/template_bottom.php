<?php   
  $query = tep_db_query("
    select pd.pages_title, pd.pages_content
    from page p inner join page_description pd on p.id = pd.pages_id
    where p.id in (1,2,5) and pd.language_id = " . (int)$languages_id . "");
  $result = [];
	while( $item = tep_db_fetch_array($query) ){
		$result[] = $item ;
  }

  // query social link
  $query_link = tep_db_query("
    select title, link from social_link where status = 1 order by id asc
  ");
  $linkResult = [];
  while( $item = tep_db_fetch_array($query_link) ){
    $linkResult[] = $item ;
  }

  
?>
    <!-- Footer -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="title-footer"><span><?php echo STORE_NAME; ?></span></div>
            <ul class="footer-icon">
              <li>
                <span style="float: left;"><i class="fa fa-map-marker"></i></span> 
                <div style="float: left;">
                  <?php 
                    echo $result[2]['pages_content'];
                  ?>
                </div>
                <div class="clearfix"></div>
              </li>
              <li>
                <span><i class="fa fa-phone"></i></span> 
                <a href="tel:<?php echo STORE_PHONE;?>">
                  <?php echo STORE_PHONE; ?>
                </a>
              </li>

              <li>
                <span>
                  <i class="fa fa-envelope"></i>
                </span> 
                <a href="mailto:<?php echo STORE_OWNER_EMAIL_ADDRESS; ?>">
                  <?php echo STORE_OWNER_EMAIL_ADDRESS; ?>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="title-footer">
              <span>
                <?php 
                  echo $result[1]['pages_title'];
                ?>
              </span>
            </div>
            <p>
              <?php 
                // strip tags to avoid breaking any html
                $follow = strip_tags($result[1]['pages_content']);
                if($setLanguage == '?language=en'){
                  $length = 300;
                }else{
                  $length = 500;
                }
                if (strlen($follow) > $length) {
                    // truncate string
                    $stringCut = substr($follow, 0, $length);
                    // make sure it ends in a word so assassinate doesn't become ass...
                    $follow = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'. tep_href_link(FILENAME_PAGES, 'pages_id=2') . $setLanguage .'">Read More</a>'; 
                }
                echo $follow;
              ?>
            </p>
            <ul class="follow-us">
              <li>
                <a href="https://<?php echo $linkResult[0]['link'];?>" target="_blank">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li>
                <a href="https://<?php echo $linkResult[1]['link'];?>" target="_blank">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li>
                <a href="https://<?php echo $linkResult[2]['link'];?>" target="_blank">
                  <i class="fa fa-google-plus"></i>
                </a>
              </li>
              <li>
                <a href="https://<?php echo $linkResult[3]['link'];?>" target="_blank">
                  <i class="fa fa-instagram"></i>
                </a>
              </li>
              <li>
                <a href="https://<?php echo $linkResult[5]['link'];?>" target="_blank">
                  <i class="fa fa-rss"></i>
                </a>
            </li>
            </ul>
          </div>
          <div class="clearfix visible-sm-block"></div>
          <div class="col-md-3 col-sm-6">
            <div class="title-footer">
              <span>
                <?php 
                  echo $result[0]['pages_title'];
                ?>
              </span>
            </div>
            <ul>
              <li>
                <?php 
                  // strip tags to avoid breaking any html
                  $string = strip_tags($result[0]['pages_content']);
                  if($setLanguage == '?language=en'){
                    $length = 300;
                  }else{
                    $length = 500;
                  }
                  if (strlen($string) > $length) {

                      // truncate string
                      $stringCut = substr($string, 0, $length);

                      // make sure it ends in a word so assassinate doesn't become ass...
                      $string = substr($stringCut, 0, strrpos($stringCut, ' ')).
                        '... <a href="'. tep_href_link(FILENAME_PAGES, 'pages_id=1') . $setLanguage .'">Read More</a>'; 
                  }
                  echo $string;
                ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="text-center copyright">
        <?php echo TEXT_COPY_RIGHT . ' ' . STORE_NAME . ' '  . TEXT_RIGHT_RESERVED . ' '  . TEXT_POWER_BY; ?>  
        <a href="https://www.facebook.com/skwebsolution/" target="_blank">Skweb Solution</a>.
      </div>
    </div>
    <!-- End Footer -->

    <script src="assets/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.js"></script>

    <script src="assets/js/bootstrap-select.js"></script>
    <script src="assets/js/bootstrap3-typeahead.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/bootstrap-toolkit.js"></script>
    <script src="assets/js/mimity.js"></script>
</body>
</html>
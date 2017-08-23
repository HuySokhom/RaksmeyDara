<?php   
  $query = tep_db_query("
    select *
    from page_description
    where pages_id in (1,2) and language_id = " . (int)$languages_id . "");
  $result = [];
	while( $item = tep_db_fetch_array($query) ){
		$result[] = $item ;
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
                <span><i class="fa fa-map-marker"></i></span> 
                <?php echo nl2br(STORE_ADDRESS); ?></li>
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
                echo $result[1]['pages_content'];
              ?>
            </p>
            <ul class="follow-us">
              <li>
                <a href="https://www.facebook.com/raksmeydaradaemtailor/" target="_blank">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa fa-rss"></i></a></li>
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
                  echo $result[0]['pages_content'];
                ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="text-center copyright">
        Copyright &copy; 2017 <?php echo STORE_NAME; ?> All right reserved. 
        Power by <a href="https://www.facebook.com/skwebsolution/" target="_blank">Skweb Solution</a>.
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
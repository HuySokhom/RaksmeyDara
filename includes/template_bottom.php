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
            <div class="title-footer"><span>Follow Us</span></div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum</p>
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
            <div class="title-footer"><span>About Us</span></div>
            <ul>
              <li>
                Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et doloremmagna aliqua. Ut enim ad minim... <a href="login.html#">Read More</a>
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
</body>
</html>

    <!-- Top Header -->
    <div class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <ul class="list-inline pull-left">
              <li class="hidden-xs">
                <a href="tel:<?php echo STORE_PHONE;?>">
                  <i class="fa fa-phone"></i> 
                  <?php echo STORE_PHONE;?>
                </a>
              </li>
              <li class="hidden-xs">
                <a href="mailto:<?php echo STORE_OWNER_EMAIL_ADDRESS;?>">
                  <i class="fa fa-envelope"></i> 
                  <?php echo STORE_OWNER_EMAIL_ADDRESS;?>
                </a>
              </li>
            </ul>
            <!-- <ul class="list-inline pull-right">
              <li class="hidden-xs"><a href="wishlist.html"><i class="fa fa-heart"></i> Wishlist (3)</a></li>
              <li class="hidden-xs"><a href="compare.html"><i class="fa fa-align-left"></i> Compare (4)</a></li>
              <li>
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Login <span class="caret"></span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-login" aria-labelledby="dropdownLogin" data-dropdown-in="zoomIn" data-dropdown-out="fadeOut">
                    <form>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><span> Remember me</span>
                        </label>
                      </div>
                      <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-long-arrow-right"></i> Login</button>
                      <a class="btn btn-default btn-sm pull-right" href="register.html" role="button">I Want to Register</a>
                    </form>
                  </div>
                </div>
              </li>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Top Header -->

    <!-- Middle Header -->
    <div class="middle-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3 logo">
              <?php
                echo '<a href="' . tep_href_link('index.php') . '">
                    <img src="' . DIR_WS_IMAGES . STORE_LOGO .'" style="width:60px"
                    class="img-responsive" alt="logo"/></a>';
              ?>
          </div>
          <?php 
            echo
                tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false),
                    'get',
                    'class="form-horizontal" onsubmit="return check_form(this);"') . tep_hide_session_id();
          ?>
          <div class="col-sm-8 col-md-6 search-box m-t-2">
            <!-- <div class="input-group">
              <input type="text" class="form-control search-input" aria-label="Search here..." placeholder="Search here...">
              <span class="input-group-btn">
                <button type="button" class="btn btn-default btn-search"><i class="fa fa-search"></i></button>
              </div>
            </div> -->
            <div class="input-group">
              <input type="text" class="form-control search-input" aria-label="Search here..." placeholder="Search here...">
              <div class="input-group-btn">
                 <?php
                    echo tep_draw_pull_down_menu(
                        'categories_id',
                        tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES))),
                        NULL,
                        'id="entryCategories" class="selectpicker hidden-xs"');
                  ?>
                <button type="submit" class="btn btn-default btn-search"><i class="fa fa-search"></i></button>
              </div>
            </div>
            </form>
          </div>
          <!-- <div class="col-sm-4 col-md-3 cart-btn hidden-xs m-t-2">
            <button type="button" class="btn btn-default dropdown-toggle" id="dropdown-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="fa fa-shopping-cart"></i> Shopping Cart : 4 items <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-cart">
              <div class="media">
                <div class="media-left">
                  <a href="detail.html"><img class="media-object img-thumbnail" src="images/demo/p1-small-1.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detail.html" class="media-heading">WranglerGrey Printed Slim Fit Round Neck T-Shirt</a>
                  <div>x 1 $13.50</div>
                </div>
                <div class="media-right"><a href="login.html#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="media">
                <div class="media-left">
                  <a href="detail.html"><img class="media-object img-thumbnail" src="images/demo/p2-small-1.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detail.html" class="media-heading">CelioKhaki Printed Round Neck T-Shirt</a>
                  <div>x 1 $13.50</div>
                </div>
                <div class="media-right"><a href="login.html#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="media">
                <div class="media-left">
                  <a href="detail.html"><img class="media-object img-thumbnail" src="images/demo/p3-small-1.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detail.html" class="media-heading">CelioOff White Printed Round Neck T-Shirt</a>
                  <div>x 1 $13.50</div>
                </div>
                <div class="media-right"><a href="login.html#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="media">
                <div class="media-left">
                  <a href="detail.html"><img class="media-object img-thumbnail" src="images/demo/p4-small-1.jpg" width="50" alt="product"></a>
                </div>
                <div class="media-body">
                  <a href="detail.html" class="media-heading">Levi'sNavy Blue Printed Round Neck T-Shirt</a>
                  <div>x 1 $13.50</div>
                </div>
                <div class="media-right"><a href="login.html#" data-toggle="tooltip" title="Remove"><i class="fa fa-remove"></i></a></div>
              </div>
              <div class="subtotal-cart">Subtotal: <span>$54.00</span></div>
              <div class="text-center">
                  <div class="btn-group" role="group" aria-label="View Cart and Checkout Button">
                    <button class="btn btn-default btn-sm" type="button"><i class="fa fa-shopping-cart"></i> View Cart</button>
                    <button class="btn btn-default btn-sm" type="button"><i class="fa fa-check"></i> Checkout</button>
                  </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    <!-- End Middle Header -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-default shadow-navbar" role="navigation">
      <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- <a href="cart.html" class="btn btn-default btn-cart-xs visible-xs pull-right">
              <i class="fa fa-shopping-cart"></i> Cart : 4 items
            </a> -->
          </div>
          <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <?php
                echo tep_get_categories_list();
                ?>
              <li class="dropdown hide">
                <a href="login.html#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  Pages <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="blog.html">Blog</a></li>
                  <li><a href="blog-detail.html">Blog Detail</a></li>
                  <li><a href="checkout2.html">Checkout v2</a></li>
                  <li><a href="compare.html">Compare</a></li>
                  <li><a href="contact.html">Contact Us</a></li>
                  <li><a href="404.html">Error 404</a></li>
                  <li><a href="faq.html">FAQ</a></li>
                  <li><a href="index2.html">Home (Vertical Menu)</a></li>
                  <li><a href="login.html">Login</a></li>
                  <li><a href="detail.html">Product Detail</a></li>
                  <li><a href="register.html">Register</a></li>
                  <li><a href="typography.html">Typography</a></li>
                  <li><a href="wishlist.html">Wishlist</a></li>
                  <li class="dropdown dropdown-submenu">
                    <a href="login.html#" class="dropdown-toggle" data-toggle="dropdown">Submenu</a>
                    <ul class="dropdown-menu">
                      <li><a href="login.html#">Submenu Link 1</a></li>
                      <li><a href="login.html#">Submenu Link 2</a></li>
                      <li><a href="login.html#">Submenu Link 3</a></li>
                      <li><a href="login.html#">Submenu Link 4</a></li>
                      <li class="dropdown dropdown-submenu">
                        <a href="login.html#" class="dropdown-toggle" data-toggle="dropdown">Sub Submenu</a>
                        <ul class="dropdown-menu">
                          <li><a href="login.html#">Sub Submenu Link 1</a></li>
                          <li><a href="login.html#">Sub Submenu Link 2</a></li>
                          <li><a href="login.html#">Sub Submenu Link 3</a></li>
                          <li><a href="login.html#">Sub Submenu Link 4</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown dropdown-submenu">
                    <a href="login.html#" class="dropdown-toggle" data-toggle="dropdown">My Account</a>
                    <ul class="dropdown-menu">
                      <li><a href="account-profile.html">My Profile</a></li>
                      <li><a href="account-address.html">My Address</a></li>
                      <li><a href="account-history.html">Order History</a></li>
                      <li><a href="account-password.html">Change Password</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
            <!-- <ul class="nav navbar-nav navbar-right navbar-feature visible-lg">
              <li><a><i class="fa fa-truck"></i> Free Shipping</a></li>
              <li><a><i class="fa fa-money"></i> Cash on Delivery</a></li>
              <li><a><i class="fa fa-lock"></i> Secure Payment</a></li>
            </ul> -->
          </div>
      </div>
    </nav>
    <!-- End Navigation Bar -->

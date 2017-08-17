<body class="nav-md">
  <div class="container body">
    <div class="main_container">
    <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="index.php" class="site_title"><i class="fa fa-home"></i> 
                    <span><?php echo STORE_NAME;?></span>
                </a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile">
                <div class="profile_pic">
                    <img src="assets/images/icon.png" alt="" class="img-circle profile_img">
                </div>
                <div class="profile_info">
                    <span>Welcome,</span>
                    <h2><?php echo $admin['username'];?></h2>
                </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <h3 style="margin-top:70px;"></h3>
                    <ul class="nav side-menu">
                         <li>
                            <a ui-sref="dashboard">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-table"></i> 
                                Catalog
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li ui-sref-active="active">
                                    <a ui-sref="category">
                                        Categories
                                    </a>
                                </li>
                                <li ui-sref-active="active">
                                    <a ui-sref="product">
                                        Products
                                    </a>
                                </li>
                                <li ui-sref-active="active">
                                    <a ui-sref="slider">
                                        Image Slider
                                    </a>
                                </li>
                                <!-- <li ui-sref-active="active">
                                    <a ui-sref="user">
                                        Users
                                    </a>
                                </li> -->
                               
                                <li ui-sref-active="active">
                                    <a ui-sref="content">
                                        Content
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-cog"></i> 
                                Setting
                                <span class="fa fa-chevron-down"></span>
                            </a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="administrators.php">
                                        Administrators
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a ui-sref="license">
                                <i class="fa fa-laptop"></i>
                                License
                                <span class="label label-success pull-right">Flag</span>
                            </a>
                        </li>
                    </ul>
                </div>            
            </div>
            <!-- /sidebar menu -->            
        </div>
    </div>
    <!-- top navigation -->
    <div class="top_nav">
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>                
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" 
                        data-toggle="dropdown" aria-expanded="false">
                            <img src="assets/images/icon.png" alt="">
                            <?php echo $admin['username'];?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="javascript:;"> Profile</a></li>
                            <li>
                                <a href="javascript:;">
                                    <span class="badge bg-red pull-right">50%</span>
                                    <span>Settings</span>
                                </a>
                            </li>
                            <li><a href="javascript:;">Help</a></li>
                            <li><a href="login.php?action=logoff"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                        </ul>
                    </li>                    
                    <li role="presentation" class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-green">6</span>
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            <li>
                                <a>
                                  <span class="image"><img src="assets/images/icon.png" alt="Profile Image" /></span>
                                  <span>
                                    <span>alert</span>
                                    <span class="time">3 mins ago</span>
                                  </span>
                                  <span class="message">
                                    Nothing
                                  </span>
                                </a>
                            </li>
                            <li>
                                <div class="text-center">
                                    <a>
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /top navigation -->
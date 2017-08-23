<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>  data-ng-app="main">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
  <meta name="robots" content="noindex,nofollow">
  <link rel="shortcut icon" href="assets/images/icon.png">
  <title update-title><?php echo STORE_NAME; ?> | Admin</title>
  <base href="<?php echo ($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_ADMIN : HTTP_SERVER . DIR_WS_ADMIN; ?>" />
  
  <link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/gentelella.min.css">
  <link rel="stylesheet" type="text/css" href="assets/style.css">
  <link rel="stylesheet" type="text/css" href="js/ng/lib/trix/custom.css">
</head>


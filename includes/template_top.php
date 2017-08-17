<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>  xmlns:ng="http://angularjs.org/" data-ng-app="main">
<head>
    <meta charset="<?php echo CHARSET; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo tep_output_string_protected($oscTemplate->getTitle()); ?></title>
    <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
    <meta name="description" http-equiv="Description" content="Fashion shop, Reaksmey dara tailor,  <?php echo tep_output_string_protected($oscTemplate->getTitle()); ?>">
    <meta name="keywords" content="Fashion shop in cambodia, <?php echo tep_output_string_protected($oscTemplate->getTitle()); ?>">
    <meta name="author" content="reaksmey dara">
    <link rel="canonical" href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
    <meta http-equiv="ROBOTS" content="INDEX, FOLLOW">
    <link rel="shortcut icon" href="<?php echo DIR_WS_IMAGES . STORE_LOGO;?>">      
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/bootstrap-select.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.css" rel="stylesheet">
    <link href="assets/css/style.teal.flat.css" rel="stylesheet" id="theme">

    <meta property="og:title" content="<?php echo STORE_NAME; ?>">
    <meta property="og:url" content="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="<?php echo STORE_NAME; ?>">
    <meta property="og:type" content="website">

    <meta property="og:image" content="<?php echo DIR_WS_IMAGES . STORE_LOGO;?>">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Go to www.addthis.com/dashboard to customize your tools --> 
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57849c71a603c3db"></script> 
<?php 
    echo $oscTemplate->getBlocks('header_tags'); 
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);
?>
</head>
<body class="cms-index-index cms-home-page home-1">
    <?php require(DIR_WS_INCLUDES . 'header.php');?>

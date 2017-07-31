<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }

  require(DIR_WS_INCLUDES . 'template_top.php');
  require(DIR_WS_INCLUDES . 'header.php');
?>
  <div class="right_col" role="main"></div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            Copyright &copy; <?php echo date('Y'); ?> Power By
              <a href="https://www.facebook.com/skwebsolution/" target="_blank">
                SK Web Solution
              </a>
        </div>
        <div class="clearfix"></div>
    </footer>
<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

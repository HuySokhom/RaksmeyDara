<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    if ( !isset($HTTP_GET_VARS['cookie_test']) ) {
      $all_get = tep_get_all_get_params();

      tep_redirect(tep_href_link(FILENAME_LOGIN, $all_get . (empty($all_get) ? '' : '&') . 'cookie_test=1', 'SSL'));
    }

    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
  }

// login content module must return $login_customer_id as an integer after successful customer authentication
  $login_customer_id = false;

  $page_content = $oscTemplate->getContent('login');

  if ( is_int($login_customer_id) && ($login_customer_id > 0) ) {
    if (SESSION_RECREATE == 'True') {
      tep_session_recreate();
    }

    $customer_info_query = tep_db_query("select c.customers_limit_products, c.customers_email_address, c.user_type, c.customers_default_address_id, ab
.entry_country_id, ab.entry_zone_id from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " ab on (c.customers_id = ab.customers_id and c.customers_default_address_id = ab.address_book_id) where c.customers_id = '" . (int)$login_customer_id . "'");
    $customer_info = tep_db_fetch_array($customer_info_query);

    $customer_id = $login_customer_id;
    tep_session_register('customer_id');

    $customers_email_address = $customer_info['customers_email_address'];
    tep_session_register('customers_email_address');


    $user_type = $customer_info['user_type'];
    tep_session_register('user_type');

    $customer_default_address_id = $customer_info['customers_default_address_id'];
    tep_session_register('customer_default_address_id');


    $customer_country_id = $customer_info['entry_country_id'];
    tep_session_register('customer_country_id');

    $customer_zone_id = $customer_info['entry_zone_id'];
    tep_session_register('customer_zone_id');

    tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1, password_reset_key = null, password_reset_date = null where customers_info_id = '" . (int)$customer_id . "'");

// reset session token
    $sessiontoken = md5(tep_rand() . tep_rand() . tep_rand() . tep_rand());

// restore cart contents
    $cart->restore_contents();

    if (sizeof($navigation->snapshot) > 0) {
      $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
      $navigation->clear_snapshot();
      tep_redirect($origin_href);
    }

    tep_redirect(tep_href_link(FILENAME_ACCOUNT));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LOGIN, '', 'SSL'));

  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<br/>
<div class="container">
  <?php
  if ($messageStack->size('login') > 0) {
      echo $messageStack->output('login');
  }
  ?>
    <div class="col-md-3">
      <div class="filter-stacked">
        <?php require('advanced_search_box_right.php');?>
      </div>
    </div>
    <div class="col-md-9">
      <?php echo $page_content; ?>
    </div>
</div>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

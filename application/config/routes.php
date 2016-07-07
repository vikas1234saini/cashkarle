<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'front/index';
$route['404_override'] = '';


/*admin*/
$route[''] = 'front/index';
$route['welcome'] = 'user/welcome';

$route['updatecategory'] = 'cron/updatecategory';
$route['addproduct/(:any)'] = 'cron/addproduct/$1';
$route['addoffer/(:any)'] = 'cron/addoffer/$1';
$route['getoffer/(:any)'] = 'cron/getoffer/$1';
$route['updateofferimage/(:any)'] = 'cron/updateofferimage/$1';
$route['updateofferurl/(:any)'] = 'cron/updateofferurl/$1';
$route['process/(:any)/(:any)'] = 'product/process/$1/$2';
$route['oprocess/(:any)/(:any)'] = 'product/offerprocess/$1/$2';
$route['ocprocess/(:any)/(:any)'] = 'product/offercouponprocess/$1/$2';

$route['getcoupon/(:any)'] = 'cron/getcoupon/$1';
$route['flipkartorder/(:any)'] = 'cron/flipkartorder/$1';
$route['snapdealorder'] = 'cron/snapdealorder';
$route['hasofferorder'] = 'cron/hasofferorder';
$route['newslettersub'] = 'fuser/newslettersub';

$route['search/(:any)'] = 'product/search/$1';
$route['suggest'] = 'product/suggest';
$route['top-product'] = 'product/productlist/featured';
$route['top-coupon'] = 'product/offerlist/featured';
$route['searchajax'] = 'product/searchajax';
$route['create_user'] = 'fuser/create_member';
$route['flogin'] = 'fuser/validate_credentials';
$route['flogout'] = 'fuser/logout';
$route['forgot_password'] = 'fuser/forgot_password';
$route['changepassword'] = 'fuser/change_password';
$route['changepasswordpost'] = 'fuser/change_password_post';
$route['editprofile'] = 'fuser/edit_profile';
$route['updateprofile'] = 'fuser/update_post';
$route['updateimage'] = 'fuser/update_image';
$route['paymentsetting'] = 'fuser/paymentsetting';
$route['paymentpost'] 	= 'fuser/paymentpost';
$route['contact'] 	= 'fuser/contact';
$route['addcontact'] 	= 'fuser/addcontact';
$route['terms'] 	= 'fuser/terms';
$route['ticket_info'] 	= 'fuser/ticket_info';
$route['reopen'] 	= 'fuser/reopen';

$route['updateaccount'] = 'fuser/update_account';
$route['addlink'] = 'fuser/addlink';
$route['mailtest'] = 'front/mailtest';


$route['facebook'] = 'fuser/facebook';
$route['googleplus'] = 'fuser/googleplus';
$route['linkedin'] = 'fuser/linkedin';
$route['twitter'] = 'fuser/twitter';
$route['twitterloginlink'] = 'fuser/get_twitter_login_url';
$route['admin/twitter_back'] = 'fuser/twitterlogin';
$route['admin/export/(:any)'] = 'admin_export/index/$1';


$route['admin/getofferorder'] = 'admin_offer/getofferorder';
$route['admin/getproductorder'] = 'admin_product/getproductorder';
$route['admin/getcontactorder'] = 'admin_contact/getcontactorder';
$route['admin/getuseroption'] = 'admin_user/getuseroption';
$route['admin/getticketoption'] = 'admin_ticket/getticketoption';

$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';
$route['admin/userlist'] = 'user/ajax_list_user';

$route['admin/category'] = 'admin_category/index';
$route['admin/category/add'] = 'admin_category/add';
$route['admin/category/update'] = 'admin_category/update';
$route['admin/category/update/(:any)'] = 'admin_category/update/$1';
$route['admin/category/updatestatus/(:any)/(:any)'] = 'admin_category/updatestatus/$1/$2';
$route['admin/category/delete/(:any)'] = 'admin_category/delete/$1';
$route['admin/category/(:any)'] = 'admin_category/index/$1';

$route['admin/brand'] = 'admin_brand/index';
$route['admin/brand/add'] = 'admin_brand/add';
$route['admin/brand/update'] = 'admin_brand/update';
$route['admin/brand/updatestatus/(:any)/(:any)'] = 'admin_brand/updatestatus/$1/$2';
$route['admin/brand/update/(:any)'] = 'admin_brand/update/$1';
$route['admin/brand/delete/(:any)'] = 'admin_brand/delete/$1';
$route['admin/brand/(:any)'] = 'admin_brand/index/$1';

$route['admin/coupon'] = 'admin_coupon/index';
$route['admin/coupon/add'] = 'admin_coupon/add';
$route['admin/coupon/update'] = 'admin_coupon/update';
$route['admin/coupon/updatestatus/(:any)/(:any)'] = 'admin_coupon/updatestatus/$1/$2';
$route['admin/coupon/update/(:any)'] = 'admin_coupon/update/$1';
$route['admin/coupon/delete/(:any)'] = 'admin_coupon/delete/$1';
$route['admin/coupon/(:any)'] = 'admin_coupon/index/$1';
$route['admin/couponoffer/(:any)'] = 'admin_coupon/couponoffer/$1';

$route['admin/ticket'] = 'admin_ticket/index';
$route['admin/ticket/add'] = 'admin_ticket/add';
$route['admin/ticket/update'] = 'admin_ticket/update';
$route['admin/ticket/updatestatus/(:any)/(:any)'] = 'admin_ticket/updatestatus/$1/$2';
$route['admin/ticket/update/(:any)'] = 'admin_ticket/update/$1';
$route['admin/ticket/delete/(:any)'] = 'admin_ticket/delete/$1';
$route['admin/ticket/reply/(:any)'] = 'admin_ticket/reply/$1';
$route['admin/ticket/(:any)'] = 'admin_ticket/index/$1';


$route['admin/agent'] = 'admin_agent/index';
$route['admin/agent/add'] = 'admin_agent/add';
$route['admin/agent/update'] = 'admin_agent/update';
$route['admin/agent/update/(:any)'] = 'admin_agent/update/$1';
$route['admin/agent/delete/(:any)'] = 'admin_agent/delete/$1';
$route['admin/agent/(:any)'] = 'admin_agent/index/$1'; //$1 = page number

$route['admin/offer'] = 'admin_offer/index';
$route['admin/offer/add'] = 'admin_offer/add';
$route['admin/offer/update'] = 'admin_offer/update';
$route['admin/offer/updatestatus/(:any)/(:any)'] = 'admin_offer/updatestatus/$1/$2';
$route['admin/offer/updatefeatured/(:any)/(:any)'] = 'admin_offer/updatefeatured/$1/$2';
$route['admin/offer/update/(:any)'] = 'admin_offer/update/$1';
$route['admin/offer/delete/(:any)'] = 'admin_offer/delete/$1';
$route['admin/offer/(:any)'] = 'admin_offer/index/$1';


$route['admin/banner'] = 'admin_banner/index';
$route['admin/banner/add'] = 'admin_banner/add';
$route['admin/banner/orderset'] = 'admin_banner/orderset';
$route['admin/banner/update'] = 'admin_banner/update';
$route['admin/banner/updatestatus/(:any)/(:any)'] = 'admin_banner/updatestatus/$1/$2';
$route['admin/banner/updatefeatured/(:any)/(:any)'] = 'admin_banner/updatefeatured/$1/$2';
$route['admin/banner/update/(:any)'] = 'admin_banner/update/$1';
$route['admin/banner/delete/(:any)'] = 'admin_banner/delete/$1';
$route['admin/banner/(:any)'] = 'admin_banner/index/$1';

$route['admin/contact'] = 'admin_contact/index';
$route['admin/contact/add'] = 'admin_contact/add';
$route['admin/contact/update'] = 'admin_contact/update';
$route['admin/contact/view'] = 'admin_contact/view';
$route['admin/contact/updatestatus/(:any)/(:any)'] = 'admin_contact/updatestatus/$1/$2';
$route['admin/contact/updatefeatured/(:any)/(:any)'] = 'admin_contact/updatefeatured/$1/$2';
$route['admin/contact/update/(:any)'] = 'admin_contact/update/$1';
$route['admin/contact/view/(:any)'] = 'admin_contact/view/$1';
$route['admin/contact/delete/(:any)'] = 'admin_contact/delete/$1';
$route['admin/contact/(:any)'] = 'admin_contact/index/$1';

$route['admin/log'] = 'admin_log/index';
$route['admin/log/add'] = 'admin_log/add';
$route['admin/log/update'] = 'admin_log/update';
$route['admin/log/updatestatus/(:any)/(:any)'] = 'admin_log/updatestatus/$1/$2';
$route['admin/log/updatefeatured/(:any)/(:any)'] = 'admin_log/updatefeatured/$1/$2';
$route['admin/log/update/(:any)'] = 'admin_log/update/$1';
$route['admin/log/delete/(:any)'] = 'admin_log/delete/$1';
$route['admin/log/(:any)'] = 'admin_log/index/$1';

$route['admin/product'] = 'admin_product/index';
$route['admin/product/add'] = 'admin_product/add';
$route['admin/product/update'] = 'admin_product/update';
$route['admin/product/updatestatus/(:any)/(:any)'] = 'admin_product/updatestatus/$1/$2';
$route['admin/product/updatefeatured/(:any)/(:any)'] = 'admin_product/updatefeatured/$1/$2';
$route['admin/product/update/(:any)'] = 'admin_product/update/$1';
$route['admin/product/delete/(:any)'] = 'admin_product/delete/$1';
$route['admin/product/(:any)'] = 'admin_product/index/$1';

$route['admin/user'] = 'admin_user/index';
$route['admin/user/add'] = 'admin_user/add';
$route['admin/user/update'] = 'admin_user/update';
$route['admin/user/updatestatus/(:any)/(:any)'] = 'admin_user/updatestatus/$1/$2';
$route['admin/user/update/(:any)'] = 'admin_user/update/$1';
$route['admin/user/delete/(:any)'] = 'admin_user/delete/$1';
$route['admin/user/(:any)'] = 'admin_user/index/$1';
$route['profile'] = 'fuser/profile';
$route['myearning'] = 'fuser/myearning';
$route['payments'] = 'fuser/payments';
$route['missingcashback'] = 'fuser/missingcashback';
$route['addticket'] = 'fuser/addticket';
$route['addticketpost'] = 'fuser/addticketpost';
$route['getlistretailer'] = 'fuser/getlistretailer';
$route['captcha_refresh'] = 'captcha_controller/captcha_refresh';
$route['paytmpayment'] = 'fuser/paytmPaytemt';
$route['pauumoney'] = 'fuser/pauumoney';
$route['mobikwik'] = 'fuser/mobikwik';



$route['admin/order'] = 'admin_order/index';
$route['admin/order/add'] = 'admin_order/add';
$route['admin/order/update'] = 'admin_order/update';
$route['admin/order/updatestatus/(:any)/(:any)'] = 'admin_order/updatestatus/$1/$2';
$route['admin/order/update/(:any)'] = 'admin_order/update/$1';
$route['admin/order/delete/(:any)'] = 'admin_order/delete/$1';
$route['admin/order/(:any)'] = 'admin_order/index/$1';

$route['admin/newsletter'] = 'admin_newsletter/index';
$route['admin/newsletter/add/(:any)'] = 'admin_newsletter/add/$1';
$route['admin/newsletter/update'] = 'admin_newsletter/update';
$route['admin/newsletter/updatestatus/(:any)/(:any)'] = 'admin_newsletter/updatestatus/$1/$2';
$route['admin/newsletter/update/(:any)'] = 'admin_newsletter/update/$1';
$route['admin/newsletter/delete/(:any)'] = 'admin_newsletter/delete/$1';
$route['admin/newsletter/(:any)'] = 'admin_newsletter/index/$1';

$route['admin/flipkartdiscount'] = 'admin_flipkartdiscount/index';
$route['admin/flipkartdiscount/add'] = 'admin_flipkartdiscount/add';
$route['admin/flipkartdiscount/update'] = 'admin_flipkartdiscount/update';
$route['admin/flipkartdiscount/updatestatus/(:any)/(:any)'] = 'admin_flipkartdiscount/updatestatus/$1/$2';
$route['admin/flipkartdiscount/update/(:any)'] = 'admin_flipkartdiscount/update/$1';
$route['admin/flipkartdiscount/delete/(:any)'] = 'admin_flipkartdiscount/delete/$1';
$route['admin/flipkartdiscount/(:any)'] = 'admin_flipkartdiscount/index/$1';

$route['admin/snapdealdiscount'] = 'admin_snapdealdiscount/index';
$route['admin/snapdealdiscount/add'] = 'admin_snapdealdiscount/add';
$route['admin/snapdealdiscount/update'] = 'admin_snapdealdiscount/update';
$route['admin/snapdealdiscount/updatestatus/(:any)/(:any)'] = 'admin_snapdealdiscount/updatestatus/$1/$2';
$route['admin/snapdealdiscount/update/(:any)'] = 'admin_snapdealdiscount/update/$1';
$route['admin/snapdealdiscount/delete/(:any)'] = 'admin_snapdealdiscount/delete/$1';
$route['admin/snapdealdiscount/(:any)'] = 'admin_snapdealdiscount/index/$1';

$route['admin/amazondiscount'] = 'admin_amazondiscount/index';
$route['admin/amazondiscount/add'] = 'admin_amazondiscount/add';
$route['admin/amazondiscount/update'] = 'admin_amazondiscount/update';
$route['admin/amazondiscount/updatestatus/(:any)/(:any)'] = 'admin_amazondiscount/updatestatus/$1/$2';
$route['admin/amazondiscount/update/(:any)'] = 'admin_amazondiscount/update/$1';
$route['admin/amazondiscount/delete/(:any)'] = 'admin_amazondiscount/delete/$1';
$route['admin/amazondiscount/(:any)'] = 'admin_amazondiscount/index/$1';


$route['admin/flipkartofferdiscount'] = 'admin_flipkartofferdiscount/index';
$route['admin/flipkartofferdiscount/add'] = 'admin_flipkartofferdiscount/add';
$route['admin/flipkartofferdiscount/update'] = 'admin_flipkartofferdiscount/update';
$route['admin/flipkartofferdiscount/updatestatus/(:any)/(:any)'] = 'admin_flipkartofferdiscount/updatestatus/$1/$2';
$route['admin/flipkartofferdiscount/update/(:any)'] = 'admin_flipkartofferdiscount/update/$1';
$route['admin/flipkartofferdiscount/delete/(:any)'] = 'admin_flipkartofferdiscount/delete/$1';
$route['admin/flipkartofferdiscount/(:any)'] = 'admin_flipkartofferdiscount/index/$1';

$route['category/(:any)'] = 'product/category_list/$1';
$route['brand/(:any)'] = 'product/search/brand-$1';
$route['coupon/(:any)'] = 'product/offerdetails/$1/$2';
$route['couponlist/(:any)'] = 'product/couponlist/$1';
$route['coupondetails/(:any)'] = 'product/coupondetails/$1';
$route['(:any)/(:any)'] = 'product/index/$1/$2';
$route['(:any)'] = 'product/search/catsearch-$1';

/*$route['admin/snapdealdiscount'] 	= 'admin_discount/snapdeal';
$route['admin/amazondiscount'] 		= 'admin_discount/amazon';
$route['admin/flipkartdiscount'] 	= 'admin_discount/flipkart';*/


/* End of file routes.php */
/* Location: ./application/config/routes.php */
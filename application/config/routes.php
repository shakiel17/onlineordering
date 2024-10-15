<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//===========================User Route=========================
$route['cancel_user_booking/(:any)/(:any)'] = 'pages/cancel_user_booking/$1/$2';
$route['update_profile'] = 'pages/update_profile';
$route['user_profile'] = 'pages/user_profile';
$route['purchase_history'] = 'pages/purchase_history';
$route['view_invoice/(:any)'] = 'pages/view_invoice/$1';
$route['checkout'] = 'pages/checkout';
$route['update_quantity/(:any)/(:any)'] = 'pages/update_quantity/$1/$2';
$route['manage_cart'] = 'pages/manage_cart';
$route['add_to_cart'] = 'pages/add_to_cart';
$route['search_product'] = 'pages/search_product';
$route['user_logout'] = 'pages/user_logout';
$route['user_registration'] = 'pages/user_registration';
$route['user_authentication'] = 'pages/user_authentication';
$route['user_login'] = 'pages/user_login';
$route['view_product_details/(:any)'] = 'pages/view_product_details/$1';
$route['view_product_category/(:any)'] = 'pages/view_product_category/$1';
//===========================User Route=========================
//===========================Admin Routes=======================
$route['monthly_sales'] = 'pages/monthly_sales';
$route['weekly_sales'] = 'pages/weekly_sales';
$route['daily_sales'] = 'pages/daily_sales';
$route['manage_report'] = 'pages/manage_report';
$route['complete_booking/(:any)'] = 'pages/complete_booking/$1';
$route['cancel_booking/(:any)'] = 'pages/cancel_booking/$1';
$route['accept_booking/(:any)'] = 'pages/accept_booking/$1';
$route['manage_order'] = 'pages/manage_order';
$route['view_product_image/(:any)'] = 'pages/view_product_image/$1';
$route['save_product_image'] = 'pages/save_product_image';
$route['delete_product/(:any)'] = 'pages/delete_product/$1';
$route['add_quantity'] = 'pages/add_quantity';
$route['save_product'] = 'pages/save_product';
$route['manage_product'] = 'pages/manage_product';
$route['admin_logout'] = 'pages/admin_logout';
$route['admin_main'] = 'pages/admin_main';
$route['admin_authentication'] = 'pages/admin_authentication';
//===========================Admin Routes=======================
$route['admin'] = 'pages/admin';
$route['default_controller'] = 'pages/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

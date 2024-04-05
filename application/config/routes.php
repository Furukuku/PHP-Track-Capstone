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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* ---------------- Start of GET Methods ---------------- */
$route['login'] = 'users/login';
$route['sign-up'] = 'users/signup';

// Admin Routes
$route['my-products'] = 'products/myProducts';
$route['my-products/admin-filter'] = 'products/adminFilter';
$route['product/delete/(:any)'] = 'products/delete/$1';
$route['my-products/list'] = 'products/adminProductListHtml';
$route['my-products/categories'] = 'products/adminCategoryListHtml';
$route['forms/add-product'] = 'products/addProductHtml';
$route['forms/edit-product/(:any)'] = 'products/editProductHtml/$1';
$route['my-products/paginate/(:any)'] = 'products/paginationHtml/$1';
$route['orders'] = 'orders/index';
$route['products/admin-search/(:any)/(:any)'] = 'products/adminSearch/$1/$2';

// Customer Routes
$route['products'] = 'products/index';
$route['products/filter'] = 'products/filter';
$route['products/view/(:any)'] = 'products/viewProduct/$1';
$route['cart'] = 'carts/index';
$route['product/categories'] = 'products/customerCategoryListHtml';
$route['products/customer-search/(:any)/(:any)'] = 'products/customerSearch/$1/$2';
$route['products/list'] = 'products/customerProductListHtml';
$route['products/paginate/(:any)'] = 'products/customerPaginationHtml/$1';
$route['cart/list'] = 'carts/itemListHtml';
/* ---------------- End of GET Methods ---------------- */

/* ---------------- Start of POST Methods ---------------- */
$route['user/login'] = 'users/loginUser';
$route['user/logout'] = 'users/logout';

// Admin Routes
$route['user/create'] = 'users/create';
$route['product/create'] = 'products/create';
$route['product/update'] = 'products/update';

// Customer Routes
$route['cart/add'] = 'carts/add';
$route['cart/update'] = 'carts/update';
$route['cart/remove'] = 'carts/remove';
/* ---------------- End of POST Methods ---------------- */
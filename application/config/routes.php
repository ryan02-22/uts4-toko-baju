<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'shop';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ========================================
// ADMIN ROUTES
// ========================================
$route['admin'] = 'admin/index';
$route['admin/profile'] = 'admin/profile';
$route['admin/edit_profile'] = 'admin/edit_profile';
$route['admin/update_profile'] = 'admin/update_profile';
$route['admin/change_password'] = 'admin/change_password';

// Admin - Transaksi CRUD Routes
$route['admin/transaksi'] = 'admin/transaksi';
$route['admin/create_transaksi'] = 'admin/create_transaksi';
$route['admin/store_transaksi'] = 'admin/store_transaksi';
$route['admin/view_transaksi/(:any)'] = 'admin/view_transaksi/$1';
$route['admin/edit_transaksi/(:any)'] = 'admin/edit_transaksi/$1';
$route['admin/update_transaksi/(:any)'] = 'admin/update_transaksi/$1';
$route['admin/delete_transaksi/(:any)'] = 'admin/delete_transaksi/$1';

// ========================================
// CUSTOMER TRANSAKSI ROUTES
// ========================================
$route['transaksi'] = 'transaksi';
$route['transaksi/create'] = 'transaksi/create';
$route['transaksi/store'] = 'transaksi/store';
$route['transaksi/view/(:any)'] = 'transaksi/view/$1';
$route['transaksi/edit/(:any)'] = 'transaksi/edit/$1';
$route['transaksi/update'] = 'transaksi/update';
$route['transaksi/delete/(:any)'] = 'transaksi/delete/$1';

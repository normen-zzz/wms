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
|	https://codeigniter.com/user_guide/general/routing.html
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

// dash
$route['dashboard'] = 'user/dashboard';

// auth
$route['login'] = 'auth';

// barang
$route['barang'] = 'user/barang';
$route['barang/add'] = 'user/barang/add';
$route['barang/edit/(:num)'] = 'user/barang/edit/$1';

// customer
$route['customer'] = 'user/customer';
$route['customer/add'] = 'user/customer/add';
$route['customer/edit/(:num)'] = 'user/customer/edit/$1';

// rack
$route['rack'] = 'user/rack';
$route['rack/add'] = 'user/rack/add';
$route['rack/edit/(:num)'] = 'user/rack/edit/$1';

// inbound
$route['inbound/create'] = 'user/inbound/create_inbound';
$route['inbound/view'] = 'user/inbound/view';
$route['inbound'] = 'user/inbound';

$route['receiving'] = 'user/receiving';
$route['receiving/add/(:num)'] = 'user/receiving/add_receiving/$1';
$route['putaway/create/(:num)'] = 'user/putaway/create_putaway/$1';
$route['putaway/view'] = 'user/putaway/view';

// picklist
$route['picklist'] = 'user/picklist';
$route['picklist/add'] = 'user/picklist/add';
$route['picklist/view'] = 'user/picklist/view';


// report
$route['report'] = 'report';
$route['report/inbound'] = 'report/inbound';
$route['report/outbound'] = 'report/outbound';
$route['report/stock'] = 'report/stock';

// setting
$route['settings'] = 'user/settings/index';
$route['settings/update_setting'] = 'user/settings/update_setting';


// user
$route['users'] = 'user/users';
$route['users/create'] = 'user/users/create';
$route['users/edit/(:num)'] = 'user/users/edit/$1';
$route['users/delete/(:num)'] = 'user/users/delete/$1';
$route['users/get_all_users'] = 'user/users/get_all_users';
// users/get_user/
$route['users/get_user/(:num)'] = 'user/users/get_user/$1';


// user profile
$route['user/profile'] = 'user/profile';
$route['user/change_password'] = 'user/change_password';
$route['user/setting'] = 'user/setting';


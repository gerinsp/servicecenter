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
$route['default_controller'] = 'cekservice/progress';


$route['login']      = 'auth/index';
$route['blocked']    = 'auth/blocked';


//Routes Menu Master Produk
$route['listpelanggan']                        = 'pelanggan/listpelanggan';
$route['tambahdatapelanggan']                  = 'pelanggan/createpelanggan';
$route['editdatapelanggan/(:any)']             = 'pelanggan/editpelanggan/$1';
$route['detaildatapelanggan/(:any)']           = 'pelanggan/detailpelanggan/$1';

//Routes Menu Admin
$route['listadmin']                            = 'admin/listadmin';
$route['tambahdataadmin']                      = 'admin/createadmin';
$route['editdataadmin/(:any)']                 = 'admin/editadmin/$1';

//Routes Menu Teknisi
$route['listteknisi']                          = 'teknisi/listteknisi';
$route['tambahdatateknisi']                    = 'teknisi/createteknisi';
$route['editdatateknisi/(:any)']               = 'teknisi/editteknisi/$1';


//Routes Menu Progress
$route['viewprogress']                         = 'service/progress';


//Routes Menu Service
$route['listservice']                          = 'service/listservice';
$route['detaildataservice/(:any)']             = 'service/detailservice/$1';
$route['updatestatus/(:any)']                  = 'service/updatestatus/$1';


//Routes Profile
$route['profile']                              = 'profile/profile';
$route['editprofile']                          = 'profile/edit';
$route['ubahpassword']                         = 'profile/changepassword';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

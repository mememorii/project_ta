<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'Auth::login'); // LOGIN PAGE

$routes->group('', ['filter' => 'auth:Role,1'], function ($routes){

    $routes->get('admin/dashboard', 'DashboardController::index');

    $routes->get('admin/siswa', 'SiswaController::index');

    $routes->get('admin/guru', 'GuruController::index');

    $routes->get('admin/wali', 'WaliController::index');

    $routes->get('admin/siswa/detail/(:num)', 'SiswaController::detail/$1');

    $routes->get('admin/guru/detail/(:num)', 'GuruController::detail/$1');

    $routes->get('admin/wali/detail/(:num)', 'WaliController::detail/$1');

    $routes->get('/siswa/create', 'SiswaController::create');

    $routes->post('/siswa/store', 'SiswaController::store');

    $routes->get('siswa/edit/(:num)', 'SiswaController::edit/$1');

    $routes->post('siswa/update', 'SiswaController::update');

    $routes->get('siswa/delete/(:num)', 'SiswaController::delete/$1');

    $routes->get('/guru/create', 'GuruController::create');

    $routes->post('/guru/store', 'GuruController::store');

    $routes->get('guru/edit/(:num)', 'GuruController::edit/$1');

    $routes->post('guru/update', 'GuruController::update');

    $routes->get('guru/delete/(:num)', 'GuruController::delete/$1');

    $routes->get('/wali/create', 'WaliController::create');

    $routes->post('/wali/store', 'WaliController::store');

    $routes->get('wali/edit/(:num)', 'WaliController::edit/$1');

    $routes->post('wali/update', 'WaliController::update');

    $routes->get('wali/delete/(:num)', 'WaliController::delete/$1');

    $routes->get('/user','Auth::list');

    $routes->get('/user/create','UserController::create');

    $routes->get('user/edit/(:num)', 'Auth::edit/$1');

    $routes->get('user/delete/(:num)', 'Auth::delete/$1');

    $routes->post('user/update', 'Auth::update');

    $routes->get('user/crm/delete/(:num)', 'CrmController::delete_user/$1');

    $routes->get('/user/view', 'UserController::view');

    $routes->get('/user/detail/(:num)', 'Auth::detail/$1');

});

$routes->group('', ['filter' => 'auth:Role,2'], function ($routes){

    $routes->get('guru/dashboard', 'DashboardController::index');

    $routes->get('/crm', 'CrmController::index');

    $routes->get('crm/filter', 'CrmController::filter');

    $routes->get('guru/siswa', 'SiswaController::index');

    $routes->get('guru/guru', 'GuruController::index');

    $routes->get('guru/wali', 'WaliController::index');

    $routes->get('guru/siswa/detail/(:num)', 'SiswaController::detail/$1');

    $routes->get('guru/guru/detail/(:num)', 'GuruController::detail/$1');

    $routes->get('guru/wali/detail/(:num)', 'WaliController::detail/$1');

    $routes->get('crm/delete/(:num)', 'CrmController::delete/$1');

});

$routes->group('', ['filter' => 'auth:Role,3'], function ($routes){

    $routes->get('siswa/crm', 'CrmController::index_user');

    $routes->get('siswa/crm/create', 'CrmController::create');

    $routes->get('siswa/dashboard', 'DashboardController::index_user');
   
});

$routes->group('', ['filter' => 'auth:Role,4'], function ($routes){

    $routes->get('wali/crm', 'CrmController::index_user');

    $routes->get('wali/crm/create', 'CrmController::create');

    $routes->get('wali/dashboard', 'DashboardController::index_user');

});

$routes->post('/multiple-file-upload', 'CrmController::multipleUpload');

$routes->get('crm/detail/(:num)', 'CrmController::detail/$1');

$routes->post('crm/update_komentar', 'CrmController::update_komentar');

$routes->get('/crm/kode','CrmController::auto');

$routes->post('/crm/store', 'CrmController::Userstore');

$routes->get('comment/delete/(:num)', 'CrmController::comment_delete/$1');

$routes->post('crm/close', 'CrmController::close');

$routes->get('notification','GuruController::showSheetAlertMessages');

$routes->get('user/account','Auth::account');

$routes->get('user/profile/(:num)','Auth::profile/$1');

$routes->get('siswa/export/(:num)', 'SiswaController::cetak/$1');
$routes->get('guru/export/(:num)', 'GuruController::cetak/$1');
$routes->get('wali/export/(:num)', 'WaliController::cetak/$1');
$routes->get('crm/export/(:num)', 'CrmController::cetak/$1');
$routes->get('crm/all/export', 'CrmController::exportAll');
$routes->get('guru/all/export', 'GuruController::exportAll');
$routes->get('siswa/all/export', 'SiswaController::exportAll');
$routes->get('wali/all/export', 'WaliController::exportAll');
// routing untuk user (perserta Siswa atau keluarga)
 // menampilkan visual list data
 // menampilkan visual detail yang ada komentar
 // membuat visualisasi chart dan lain-lain



$routes->match(['get', 'post'], 'login', 'Auth::login'); // LOGIN PAGE
$routes->match(['get', 'post'], 'register', 'Auth::register'); // REGISTER PAGE
$routes->match(['get', 'post'], 'forgotpassword', 'Auth::forgotPassword'); // FORGOT PASSWORD
$routes->match(['get', 'post'], 'activate/(:num)/(:any)', 'Auth::activateUser/$1/$2'); // INCOMING ACTIVATION TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'resetpassword/(:num)/(:any)', 'Auth::resetPassword/$1/$2'); // INCOMING RESET TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'updatepassword/(:num)', 'Auth::updatepassword/$1'); // UPDATE PASSWORD
$routes->match(['get', 'post'], 'lockscreen', 'Auth::lockscreen'); // LOCK SCREEN
$routes->get('logout', 'Auth::logout'); // LOGOUT
$routes->match(['get', 'post'], 'admin/dashboard/account', 'Auth::account');
$routes->match(['get', 'post'], 'guru/dashboard/account', 'Auth::account');
$routes->match(['get', 'post'], 'siswa/dashboard/account', 'Auth::account');
$routes->match(['get', 'post'], 'wali/dashboard/account', 'Auth::account');








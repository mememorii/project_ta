<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'Auth::index'); 

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

    $routes->get('user/edit/(:num)', 'Auth::edit/$1');

    $routes->get('user/crm/delete/(:num)', 'CrmController::delete_user/$1');

    $routes->get('/user/view', 'UserController::view');

    $routes->get('/user/detail/(:num)', 'Auth::detail/$1');

    $routes->get('admin/siswapdf/(:num)', 'SiswaController::exportToPdf/$1');

    $routes->get('admin/walipdf/(:num)', 'WaliController::exportToPdf/$1');

    $routes->get('/admin/hak/(:num)', 'Auth::transferHak/$1');

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

    $routes->get('guru/siswapdf/(:num)', 'SiswaController::exportToPdf/$1');

    $routes->get('guru/walipdf/(:num)', 'WaliController::exportToPdf/$1');

    $routes->post('respond', 'CrmController::respond');

    $routes->post('crm/resolusi', 'CrmController::resolusi');

    $routes->get('crm/editResolusi/(:num)', 'CrmController::editResolusi/$1');

});

$routes->group('', ['filter' => 'auth:Role,3'], function ($routes){

    $routes->get('siswa/crm', 'CrmController::index_user');

    $routes->get('siswa/crm/create', 'CrmController::create');

    $routes->get('siswa/dashboard', 'DashboardController::index_user');

    $routes->get('siswa/survey', 'CrmController::survey');
   
});

$routes->group('', ['filter' => 'auth:Role,4'], function ($routes){

    $routes->get('wali/crm', 'CrmController::index_user');

    $routes->get('wali/crm/create', 'CrmController::create');

    $routes->get('wali/dashboard', 'DashboardController::index_user');

    $routes->get('wali/survey', 'CrmController::survey');

});

$routes->post('/multiple-file-upload', 'CrmController::multipleUpload');

$routes->get('crm/detail/(:num)', 'CrmController::detail/$1');

$routes->post('crm/update_komentar', 'CrmController::update_komentar');

$routes->post('/crm/store', 'CrmController::Userstore');

$routes->get('comment/delete/(:num)', 'CrmController::comment_delete/$1');

$routes->post('crm/close', 'CrmController::close');

$routes->get('user/account','Auth::account');

$routes->get('user/profile/(:num)','Auth::profile/$1');

$routes->match(['get', 'post'], 'changeQuestion/(:num)','Auth::changeQuestion/$1');

$routes->post('changeQuestionSave', 'Auth::changeQuestionSave');

$routes->match(['get', 'post'], 'login', 'Auth::login'); 

$routes->match(['get', 'post'], 'updatepassword/(:num)', 'Auth::updatepassword/$1'); 

$routes->get('logout', 'Auth::logout'); 

$routes->match(['get', 'post'], 'admin/dashboard/account', 'Auth::account');

$routes->match(['get', 'post'], 'guru/dashboard/account', 'Auth::account');

$routes->match(['get', 'post'], 'siswa/dashboard/account', 'Auth::account');

$routes->match(['get', 'post'], 'wali/dashboard/account', 'Auth::account');

$routes->match(['get', 'post'], 'saveForgot', 'Auth::saveForgot');

$routes->match(['get', 'post'], 'toForgot', 'Auth::toForgot');

$routes->post('securityQuestion', 'Auth::securityQuestion');

$routes->post('securityQuestionWali', 'Auth::securityQuestionWali');

$routes->match(['get', 'post'], 'changeEmail', 'Auth::changeEmail');

$routes->post('cekPertanyaan', 'Auth::cekPertanyaan');

// $routes->get('resetPassword', 'Auth::resetPassword');

$routes->post('user/update', 'Auth::update');

$routes->post('login', 'Auth::login');

$routes->post('rate', 'CrmController::rating');

$routes->post('feedback/save', 'CrmController::upload_image');

$routes->get('tab', 'CrmController::tab');

$routes->post('notification/checkNewComments', 'NotificationController::checkNewComments');

$routes->post('security', 'Auth::security');

$routes->get('lupaPassword', 'Auth::lupaPassword');

$routes->get('email', 'Auth::email');

$routes->get('viewKirimEmail', 'Auth::viewKirimEmail');

$routes->get('viewKirimEmailUser', 'Auth::viewKirimEmailUser');

$routes->post('kirimEmail', 'Auth::kirimEmail');

$routes->post('kirimEmailUser', 'Auth::kirimEmailUser');

$routes->get('viewResetPassword/(:num)', 'Auth::viewResetPassword/$1');

$routes->match(['get', 'post'], 'resetpassword/(:num)/(:any)', 'Auth::resetPassword/$1/$2'); 



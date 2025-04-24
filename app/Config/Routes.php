<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
 $routes->group('admin', static function ($routes) {
	 
    $routes->get('/', 'AdminDashboardController::index');
	
    $routes->get('dashboard', 'AdminDashboardController::index');
	
    $routes->get('users', 'AdminUserController::index');
	
    $routes->get('user', 'AdminUserController::index');
	
    $routes->post('user/doLogin', 'AdminUserController::doLogin');
	
    $routes->get('user/signup', 'AdminUserController::signup');
	
    $routes->get('user/edit', 'AdminUserController::edit');
	
    $routes->get('user/edit/(:any)', 'AdminUserController::edit/$1');
	
    $routes->post('user/edit/(:any)', 'AdminUserController::edit/$1');
	
    $routes->post('user/dit', 'AdminUserController::edit');
	
    $routes->get('user/delete/(:any)', 'AdminUserController::delete/$1');
	
    $routes->get('user/logout', 'AdminUserController::logout');
	
    $routes->get('user/state', 'AdminUserController::state');
	
    $routes->get('user/search', 'AdminUserController::search');
	
	$routes->get('settings', 'AdminSettingController::index');
		 
	$routes->post('settings', 'AdminSettingController::index');
});

$routes->group('user', static function ($routes) {
	
	$routes->get('lostpassword', 'UserController::lostpassword');
		
	$routes->post('lostpassword', 'UserController::lostpassword');
	 
	$routes->get('login', 'UserController::login');
	 
	$routes->get('signup', 'UserController::signup');
	 
	$routes->post('doLogin', 'UserController::doLogin');
	 
	$routes->get('logout', 'UserController::logout');
	
	$routes->get('edit', 'UserController::edit');
	
    $routes->post('edit', 'UserController::edit');	
 
});


$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->post('about', 'Home::about');

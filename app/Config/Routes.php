<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/topics/(:num)', 'Home::topics/$1');
$routes->get('/single/(:num)', 'Home::single/$1');
$routes->get('/search', 'Home::search');
$routes->get('/about', 'Home::about');
$routes->match(['get','post'],'/contact', 'Home::contact');

$routes->group('api', function($routes)
{
  $routes->get('category', 'Category::getCategories');
  $routes->get('topic/(:num)', 'Topic::getByCategoryId/$1');
  $routes->get('topic/search/(:alphanum)', 'Topic::searchTopics/$1');
});

$routes->get('admin', 'Users::index');
$routes->get('admin/logout', 'Users::logout');
// $routes->match(['get','post'],'admin/register', 'Users::register');

$routes->group('admin', ['filter' => 'auth'], function($routes)
{
  $routes->match(['get','post'],'profile', 'Users::profile');
  $routes->get('dashboard', 'Dashboard::index');
  $routes->match(['get','post'],'category', 'Category::index');
  $routes->get('category/delete', 'Category::delete');
  $routes->get('topic', 'Topic::index');
  $routes->post('topic', 'Topic::saveTopic');
  $routes->get('topic/delete', 'Topic::delete');

});





/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

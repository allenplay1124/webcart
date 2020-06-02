<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/{locale} ', 'Home::index');

$routes->group('api', function($routes) {
    $routes->group('migration', function ($routes) {
        $routes->post('set_login', 'Api\Migration::setLogin');
        $routes->post('set_migration', 'Api\Migration::setMigration');
        $routes->post('set_seeder', 'Api\Migration::setSeeder');
        $routes->post('set_logout', 'Api\Migration::setLogout');
    });
});

$routes->group('member', function ($routes) {
    $routes->get('login', 'Member::login');
    $routes->get('register', 'Member::register');
});

$routes->group('migration', function ($routes) {
    $routes->get('index', 'Migration::index');
    $routes->get('login', 'Migration::login');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

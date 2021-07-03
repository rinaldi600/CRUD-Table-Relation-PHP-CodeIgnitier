<?php

namespace Config;

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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Transaksi::index');
$routes->get('/Transaksi/detailPayment/(:segment)', 'Transaksi::detailPayment/$1');
$routes->get('/Transaksi/editPayment/(:segment)', 'Transaksi::editPayment/$1');
$routes->get('/Transaksi/tambahData', 'Transaksi::tambahData');
$routes->delete('/Transaksi/hapusPayment/(:segment)', 'Transaksi::hapusPayment/$1');
$routes->get('/Pembeli/Edit/(:segment)', 'Pembeli::Edit/$1');
$routes->delete('/Pembeli/Hapus/(:segment)', 'Pembeli::Hapus/$1');


$routes->get('/Transaksi/(:segment)/(:segment)', 'Transaksi::index');
$routes->get('/Pembeli/(:segment)/(:segment)', 'Pembeli::index');
$routes->get('/Transaksi/(:segment)', 'Transaksi::index');
$routes->get('/Pembeli/insert', 'Pembeli::insert');
$routes->get('/Pembeli/(:any)', 'Pembeli::PageNotFoundException');
$routes->get('/Transaksi(:any)', 'Transaksi::PageNotFoundException');





/*
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

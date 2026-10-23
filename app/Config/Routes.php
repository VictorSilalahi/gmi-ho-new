<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

$routes->get('/', 'Wilayah::index');
$routes->post('/validasi', 'Wilayah::validasi');

$routes->post('/seting/getinfodistrik', 'Distrik::get_info_distrik');
$routes->post('/seting/password/change', 'Distrik::password_change');
$routes->post('/seting/simpanalamatdistrik', 'Distrik::simpan_alamat_distrik');
$routes->post('/seting/simpankabkotadistrik', 'Distrik::simpan_kabkota_distrik');

$routes->get('/seting', 'Distrik::seting');
$routes->get('/logout', 'Distrik::logout');

$routes->get('/jemaat', 'Jemaat::index');
$routes->post('/jemaat/all', 'Jemaat::jemaat_all');

$routes->get('/gereja/stat', 'Gereja::stat');
$routes->get('/gereja/resort', 'Gereja::resort');
$routes->get('/gereja/pemetaan', 'Gereja::pemetaan');
$routes->post('/gereja/all', 'Gereja::gereja_all');




$routes->get('/aktifitas', 'Aktifitas::index');
$routes->post('/aktifitas/all', 'Aktifitas::aktifitas_all');

$routes->post('/api/periksa_token', 'Api::periksa_token');


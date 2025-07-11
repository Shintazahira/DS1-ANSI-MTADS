<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// == Dashboard Tiap Role ==
$routes->get('/', 'Home::index');
$routes->get('peninjau/dashboard', 'DashboardPeninjau::index');
$routes->get('mahasiswa/dashboard', 'DashboardMahasiswa::index');
$routes->get('dashboard/dosen', 'DashboardDosen::index', ['filter' => 'role:dosen']);
$routes->get('dashboard/kaprodi', 'DashboardKaprodi::index');

// == Auth ==
$routes->get('login', 'Login::index');
$routes->post('login/processLogin', 'Login::processLogin');
$routes->get('logout', 'Login::logout');

// == User Management ==
$routes->post('users/register', 'Users::register');
$routes->get('users/reset-password', 'Users::reset_Password');
$routes->post('users/process-reset', 'Users::process_reset');
$routes->get('users/log-aktivitas', 'Users::logAktivitas');
$routes->get('profile', 'Users::profile');
$routes->get('setting', 'Users::setting');
$routes->post('users/updateSetting', 'Users::updateSetting');
$routes->get('users/log', 'Users::log');
$routes->get('users/mahasiswa', 'Users::listMahasiswa');
$routes->get('users/dosen', 'Users::listDosen');

// ==============================================
// 🧭 BIMBINGAN
// ==============================================

// 📌 Akses untuk Kaprodi
$routes->group('bimbingan', ['filter' => 'role:kaprodi'], function($routes) {
    $routes->get('/', 'Bimbingan::index');
    $routes->get('tambah', 'Bimbingan::tambah');
    $routes->post('simpan', 'Bimbingan::simpan');
    $routes->get('edit/(:num)', 'Bimbingan::edit/$1');
    $routes->post('update/(:num)', 'Bimbingan::update/$1');
});

// 📌 Akses untuk Dosen
$routes->group('dosen', ['filter' => 'role:dosen'], function($routes) {
    $routes->get('bimbingan', 'Bimbingan::bimbinganDosen'); // URL: /dosen/bimbingan
});

// 📌 Akses untuk Mahasiswa
$routes->group('mahasiswa', ['filter' => 'role:mahasiswa'], function($routes) {
    $routes->get('bimbingan', 'Bimbingan::indexMahasiswa'); // URL: /mahasiswa/bimbingan
    $routes->get('seminar', 'DashboardMahasiswa::seminar');
});

// ==============================================
// 📌 Kaprodi - Manajemen Dosen (admin/kaprodi)
$routes->group('dosen', ['filter' => 'role:admin,kaprodi'], function($routes) {
    $routes->get('/', 'Dosen::index');
    $routes->get('tambah', 'Dosen::tambah');
    $routes->post('simpan', 'Dosen::simpan');
});

// ==============================================
// 📌 Pengajuan Proposal
$routes->group('pengajuan', function($routes) {
    $routes->get('/', 'Pengajuan::index');
    $routes->get('create', 'Pengajuan::create');
    $routes->post('store', 'Pengajuan::store');
    $routes->get('kelola', 'Pengajuan::kelola', ['filter' => 'role:kaprodi']);
    $routes->get('setuju/(:num)', 'Pengajuan::setuju/$1', ['filter' => 'role:kaprodi']);
    $routes->post('simpan-setuju', 'Pengajuan::simpanSetuju', ['filter' => 'role:kaprodi']);
    $routes->get('tolak/(:num)', 'Pengajuan::tolak/$1', ['filter' => 'role:kaprodi']);
    $routes->post('simpan-tolak', 'Pengajuan::simpanTolak', ['filter' => 'role:kaprodi']);
});

// ==============================================
// 📌 Seminar dan Sidang
$routes->get('seminar', 'Seminar::index');
$routes->get('seminar/tambah', 'Seminar::tambah');
$routes->post('seminar/simpan', 'Seminar::simpan');
$routes->get('seminar/setujui/(:num)', 'Seminar::setujui/$1');
$routes->get('seminar/hapus/(:num)', 'Seminar::hapus/$1');
$routes->get('seminar/nilai/(:num)', 'Seminar::formNilai/$1', ['filter' => 'role:dosen']);
$routes->post('seminar/nilai/(:num)', 'Seminar::simpanNilai/$1', ['filter' => 'role:dosen']);

// 📌 Sidang - Akses khusus Kaprodi
$routes->group('sidang', ['filter' => 'role:kaprodi'], function($routes) {
    $routes->get('kaprodi', 'Sidang::indexKaprodi');
    $routes->get('create', 'Sidang::create');
    $routes->post('store', 'Sidang::store');
    $routes->get('edit/(:num)', 'Sidang::edit/$1');
    $routes->post('update/(:num)', 'Sidang::update/$1');
    $routes->get('delete/(:num)', 'Sidang::delete/$1');
});

// 📌 Sidang - Akses Mahasiswa
$routes->get('sidang/mahasiswa', 'Sidang::viewMahasiswa', ['filter' => 'role:mahasiswa']);

// 📌 Sidang - Akses Dosen
$routes->get('sidang/dosen', 'Sidang::viewDosen', ['filter' => 'role:dosen']);

// ==============================================
// 📌 Topik / Proposal Skripsi
$routes->get('topik', 'Topik::index');
$routes->get('topik/tambah', 'Topik::create');
$routes->post('topik/simpan', 'Topik::store');
$routes->get('topik/edit/(:num)', 'Topik::edit/$1');
$routes->post('topik/update/(:num)', 'Topik::update/$1');
$routes->get('topik/delete/(:num)', 'Topik::delete/$1');

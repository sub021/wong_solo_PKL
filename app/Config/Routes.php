<?php

namespace Config;

use App\Controllers\PakaiController;
use App\Models\Karyawan;
use CodeIgniter\Router\Router;
use Myth\Auth\Config\Auth as AuthConfig;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use \CodeIgniter\Shield\Controllers;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'DashboardController::index');
// $routes->get('login', 'auth\LoginController::loginView');
service('auth')->routes($routes);
// service('auth')->routes($routes, ['except' => ['login']]);
// $routes->get('/', '\CodeIgniter\Shield\Controllers\LoginController::loginView', ['as' => 'login']);
$routes->group('/dashboard', static function ($routes) {
    //route barang
    $routes->get('/', 'DashboardController::index', ['as' => 'dashboard']);


    $routes->group('barang', static function ($routes) {
        $routes->get('', 'BarangController::index', ['as' => 'barang']);
        $routes->get('add', 'BarangController::show', ['as' => 'barang_add']);
        $routes->post('add', 'BarangController::barang_simpan', ['as' => 'barang_add']);
        $routes->get('edit/(:segment)', 'BarangController::showEdit/$1', ['as' => 'edit_barang']);
        $routes->put('edit/(:segment)', 'BarangController::Edit/$1', ['as' => 'eproses_barang']);
        $routes->delete('(:segment)', 'BarangController::delete/$1', ['as' => 'delete_barang']);
        $routes->get('laporan', 'BarangController::laporan', ['as' => 'lp_barang']);
        $routes->get('cetak', 'BarangController::cetak', ['as' => 'cetak_barang']);
    });

    $routes->group('supplier', static function ($routes) {
        //route supplier
        $routes->get('', 'SupplierController::index', ['as' => 'supplier']);
        $routes->get('add', 'SupplierController::add', ['as' => 'add_suplier']);
        $routes->post('add', 'SupplierController::save', ['as' => 'save_suplier']);
        $routes->get('edit/(:segment)', 'SupplierController::showEdit/$1', ['as' => 'edit_suplier']);
        $routes->put('edit/(:segment)', 'SupplierController::Edit/$1', ['as' => 'eproses_suplier']);
        $routes->delete('(:segment)', 'SupplierController::delete/$1', ['as' => 'delete_suplier']);
        $routes->get('laporan', 'SupplierController::laporan', ['as' => 'lp_suplier']);
        $routes->get('cetak', 'SupplierController::cetak', ['as' => 'cetak_suplier']);
    });
    //Barang masuk
    $routes->group('barang_masuk', static function ($routes) {
        $routes->get('', 'BrMasukController::index', ['as' => 'brmasuk']);
        $routes->get('add', 'BrMasukController::show', ['as' => 'brmasuk_add']);
        $routes->post('add', 'BrMasukController::save', ['as' => 'brmasuk_simpan']);
        $routes->get('edit/(:segment)', 'BrMasukController::showEdit/$1', ['as' => 'brmasuk_edit']);
        $routes->put('edit/(:segment)', 'BrMasukController::Edit/$1', ['as' => 'brmasuk_proses']);
        $routes->delete('(:segment)', 'BrMasukController::delete/$1', ['as' => 'delete_brmasuk']);
        $routes->get('laporan', 'BrMasukController::laporan', ['as' => 'lp_brmasuk']);
        $routes->get('cetak', 'BrMasukController::cetak', ['as' => 'cetak_brmasuk']);
    });
    //karywan

    $routes->group('karyawan', ['filter' => 'group:admin'], static function ($routes) {
        $routes->get('', 'KaryawanController::index', ['as' => 'karyawan']);
        $routes->get('add', 'KaryawanController::add', ['as' => 'add_karyawan']);
        $routes->post('add', 'KaryawanController::save', ['as' => 'save_karyawan']);
        $routes->get('edit/(:segment)', 'KaryawanController::showEdit/$1', ['as' => 'edit_karyawan']);
        $routes->put('edit/(:segment)', 'KaryawanController::edit/$1', ['as' => 'eproses_karyawan']);
        $routes->delete('(:segment)', 'KaryawanController::delete/$1', ['as' => 'delete_karyawan']);
        $routes->get('laporan', 'KaryawanController::laporan', ['as' => 'lp_karyawan']);
        $routes->get('cetak', 'KaryawanController::cetak', ['as' => 'cetak_karyawan']);
    });

    //pemakain
    $routes->group('pemakaian', static function ($routes) {
        $routes->get('', 'PakaiController::index', ['as' => 'brpakai']);
        $routes->get('add', 'PakaiController::show', ['as' => 'brpakai_add']);
        $routes->post('add', 'PakaiController::save', ['as' => 'brpakai_simpan']);
        $routes->get('edit/(:segment)', 'PakaiController::showEdit/$1', ['as' => 'brpakai_edit']);
        $routes->put('edit/(:segment)', 'PakaiController::Edit/$1', ['as' => 'brpakai_proses']);
        $routes->delete('(:segment)', 'PakaiController::delete/$1', ['as' => 'delete_brpakai']);
        $routes->get('laporan', 'PakaiController::laporan', ['as' => 'lp_brpakai']);
        $routes->get('cetak', 'PakaiController::cetak', ['as' => 'cetak_brpakai']);
        // $routes->get('tes', [PakaiController::class, 'cetak']);
    });

    //admin
    $routes->group('user', ['filter' => 'group:admin'], static function ($routes) {

        $routes->get('/', 'admin\MyAdminController::index', ['as' => 'user']);
        $routes->get('user', 'admin\MyAdminController::index', ['as' => 'user']);
        $routes->get('add', 'admin\MyAdminController::MyViewRegister', ['as' => 'addUser']);
        $routes->post('add', 'admin\MyAdminController::MyRegister', ['as' => 'user_Res']);
        $routes->get('edit/(:segment)', 'admin\MyAdminController::showEdit/$1', ['as' => 'MyEdit']);
        $routes->patch('edit/(:segment)', 'admin\MyAdminController::MyEdit/$1', ['as' => 'MyEdit_proses']);
        $routes->delete('(:segment)', 'admin\MyAdminController::MyDelete/$1', ['as' => 'MyDelete']);
        $routes->get('permission/(:segment)', 'admin\MyAdminController::MySetting/$1', ['as' => 'MyPermission']);
        $routes->patch('user/permission/(:segment)', 'admin\MyAdminController::MyPermission_pro/$1', ['as' => 'MyPermission_proses']);
    });
});

// $routes->get('/login', 'Auth::index');

// $routes->get('/register', 'Auth::register');
// $routes->post('/proses_daftar', 'Auth::proses_daftar');

// service('auth')->routes($routes);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

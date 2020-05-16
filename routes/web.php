<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

# modulo almacen: categorias de articulos/productos
Route::resource('almacen/categoria', 'CategoriaController');

# modulo almacen: gestion articulos/productos
Route::resource('almacen/articulo', 'ArticuloController');

# modulo ventas: gestion de clientes
Route::resource('ventas/cliente', 'ClienteController');

# modulo compras (a proveedor): gestion de proveedores
Route::resource('compras/proveedor', 'ProveedorController');

# modulo compras (a proveedor): comprar articulos/productos
Route::resource('compras/ingreso', 'IngresoController');

# modulo ventas: vender productos/articulos
Route::resource('ventas/venta', 'VentaController');

# modulo crud de usuarios
Route::resource('security/usuario', 'UsuarioController');

# Autenticacion y gestion de Usuarios
# para error al cerrar sesion:
Route::get('/logout', 'Auth\LoginController@logout') -> name('logout');

# para autenticar y redirigir usuarios no autenticados
Auth::routes();

# Landing page / info page de la aplicacion
Route::get('/home', 'HomeController@index')->name('home');

# en caso de no existir la ruta redirije a home
Route::get('/{slug?}', 'HomeController@index');

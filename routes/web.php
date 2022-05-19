<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ExistenciasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ClienteNuevoController;

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
    return view('auth.login');
})->middleware('guest');


Auth::routes();
Route::resources([
    'dashboard' => DashBoardController::class,
    'usuarios' => UsuariosController::class,
    'agenda' => AgendaController::class,
    'clientes' => ClientesController::class,
    'ventas' => VentasController::class,
    'compras' => ComprasController::class,
    'proveedores' => ProveedoresController::class,
    'existencias' => ExistenciasController::class,
    'productos' => ProductosController::class,
    'servicios' => ServiciosController::class,
    'roles' => RolesController::class,
    'cliente2'=>ClienteNuevoController::class,
]);

Route::get('compras/export/excel',[DashBoardController::class,'export'])->name('compras.export');
//PROVEEDOR
Route::get('proveedores/{NIT}/{state}',[ProveedoresController::class,'changeState'])->name('proveedores.changeState');
//CLIENTE
Route::get('clientes/{id}/{state}',[ClientesController::class,'changeState'])->name('clientes.changeState');
/*USUARIO Y ROLES */
Route::put('usuarios/{id}/editPassword',[UsuariosController::class,'updatePassword'])->name('usuarios.updatePassword');
Route::get('usuarios/{id}/{state}',[UsuariosController::class,'changeState'])->name('usuarios.changeState');
Route::get('perfil',[PerfilController::class,'index'])->name('usuarios.perfil');
Route::put('perfil/{id}/update',[PerfilController::class,'updateInfo'])->name('perfil.updateInfo');
Route::put('perfil/{id}/password',[PerfilController::class,'updatePassword'])->name('perfil.updatePassword');

Route::get('roles/{id}/{state}',[RolesController::class,'changeState'])->name('roles.changeState');
//AGENDA
Route::get('/agenda/listar/lista/agenda', [App\Http\Controllers\AgendaController::class, 'list'])->name('listar');
Route::post('/agenda/guardar', [App\Http\Controllers\AgendaController::class, 'store'])->name('Guardar');
Route::get('/agenda/detalle/{id}', [App\Http\Controllers\AgendaController::class, 'show'])->name('Detalle');
//PRODUCTOS
Route::get('/productos/{id}/{state}', [App\Http\Controllers\productosController::class, 'changeState'])->name('productos.changeState');
//SERVICIOS
Route::get('/servicios/{id}/{state}', [App\Http\Controllers\serviciosController::class, 'changeState'])->name('servicios.changeState');

//VENTAS


Route::get('/ventas/{id}/{state}',[VentasController::class,'changeState'])->name('changeState');
Route::get('/compras/{id}/{state}',[ComprasController::class,'changeState'])->name('changeState');


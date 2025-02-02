<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\InsertarProductoController;
use App\Http\Controllers\EditarProductoController;
use App\Http\Controllers\BorrarProductoController;
use App\Http\Controllers\AdministradorController;

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

// Inicio
Route::get("/", [InicioController::class, "inicio"]);

// Validar login
Route::post("/validar-login", [LoginController::class, "validarLogin"]);
Route::post("/validar-login-ajax", [LoginController::class, "validarLoginAjax"]);
Route::get("/cerrar-sesion", [LoginController::class, "cerrarSesion"]);

// Validar registro
Route::post("/validar-registro", [RegisterController::class, "validarRegistro"]);
Route::post("/validar-registro-ajax", [RegisterController::class, "validarRegistroAjax"]);

// Perfil
Route::get("/perfil-no-sesion", [PerfilController::class, "perfilNoSesion"]);
Route::get("/perfil", [PerfilController::class, "perfil"]);
Route::post("/guardar-perfil-img", [PerfilController::class, "guardarImgPerfil"]);
Route::post("/guardar-perfil-datos", [PerfilController::class, "guardarDatosPerfil"]);

// Usuario
Route::get("/usuario/{id}", [UsuarioController::class, "usuario"]);

// Mis productos
Route::get("/mis-productos", [ProductoController::class, "productosUsuario"]);
Route::get("/producto/{id}", [ProductoController::class, "mostrarProducto"]);
Route::post("/incrementarVisitas", [ProductoController::class, "incrementarVisitas"]);
Route::post("/vender-producto", [ProductoController::class, "venderProducto"]);

// Editar productos
Route::get("/editar-producto/{id}", [EditarProductoController::class, "editarProducto"]);
Route::post("/actualizar-producto", [EditarProductoController::class, "actualizarProducto"]);

// Insertar productos
Route::get("/subir-producto", [InsertarProductoController::class, "subirProducto"]);
Route::post("/insertar-producto", [InsertarProductoController::class, "insertarProducto"]);

// Borrar productos
Route::post("/borrar-productos", [BorrarProductoController::class, "borrarProductos"]);

// Favoritos productos
Route::get("/favoritos", [FavoritoController::class, "favoritos"]);
Route::post("/checkFavoriteProduct", [FavoritoController::class, "checkFavoriteProduct"]);
Route::post("/deleteFavoriteProduct", [FavoritoController::class, "deleteFavoriteProduct"]);

// Buscar productos
Route::get("/buscar", [BuscarController::class, "buscarProducto"]);
Route::post("/mostrarMasProductos", [BuscarController::class, "mostrarMasProductos"]);
Route::post("/filtrarProductos", [BuscarController::class, "filtrarProductos"]);
Route::get("/searchNoResults", [BuscarController::class, "searchNoResults"]);

// Administrador
Route::get("/administrador", [AdministradorController::class, "administrador"]);
Route::post("/buscarUsuario", [AdministradorController::class, "buscarUsuario"]);
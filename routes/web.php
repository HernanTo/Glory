<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Auth::routes();

Route::prefix('administration')->get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
// Usuarios
    Route::group(
        [
            'middleware' => ['auth', 'can:see.users'],
            'prefix' => 'administration'
        ], function (){
            Route::get('usuarios', [UserController::class, 'index'])->name('usuarios');
            Route::get('usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
            Route::post('usuarios/store', [UserController::class, 'store'])->name('usuarios.store');

            Route::get('usuarios/{cc}', [UserController::class, 'show'])->name('usuarios.usuario');
            Route::get('usuarios/{cc}/edit', [UserController::class, 'edit'])->name('usuarios.edit');

            Route::put('usuarios/{item}/update', [UserController::class, 'update'])->name('usuarios.update');
            Route::put('usuarios/{item}/updateRole', [UserController::class, 'updateRole'])->name('usuarios.updateRole');
            Route::post('usuarios/destroy', [UserController::class, 'destroy'])->name('usuarios.destroy');

            Route::get('clientes/{cc}', [CustomerController::class, 'show'])->name('clientes.cliente');
            Route::get('clientes/{cc}/edit', [CustomerController::class, 'edit'])->name('clientes.edit');
            Route::put('clientes/{item}/update', [CustomerController::class, 'update'])->name('clientes.update');
            Route::post('clientes/destroy', [CustomerController::class, 'destroy'])->name('clientes.destroy');
    });
// Usuarios


// Productos
    Route::group(
        [
            'middleware' => ['auth', 'can:see.products.dash'],
            'prefix' => 'administration'
        ], function (){
            Route::get('productos', [ProductController::class, 'index'])->name('productos.administration');
            Route::get('productos/create', [ProductController::class, 'create'])
                ->name('productos.administration.create')->middleware('can:create.products.dash');

            Route::post('productos/store', [ProductController::class, 'store'])
                ->name('productos.administration.store')->middleware('can:create.products.dash');
            Route::get('productos/{slug}', [ProductController::class, 'show'])->name('productos.administration.show');
            Route::get('productos/{slug}/edit', [ProductController::class, 'edit'])
                ->name('productos.administration.edit')->middleware('can:edit.products.dash');
            Route::put('productos/{product}/update', [ProductController::class, 'update'])
                ->name('productos.administration.update')->middleware('can:edit.products.dash');

            Route::post('productos/destroy', [ProductController::class, 'destroy'])
                ->name('productos.administration.destroy')->middleware('can:destroy.products.dash');
    });
// Productos

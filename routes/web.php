<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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
            'prefix' => 'administration/productos'
        ], function (){
            Route::get('/', [ProductController::class, 'index'])->name('productos.administration');
            Route::get('/create', [ProductController::class, 'create'])
                ->name('productos.administration.create')->middleware('can:create.products.dash');

            Route::post('/store', [ProductController::class, 'store'])
                ->name('productos.administration.store')->middleware('can:create.products.dash');
            Route::get('/{slug}', [ProductController::class, 'show'])->name('productos.administration.show');
            Route::get('/{slug}/edit', [ProductController::class, 'edit'])
                ->name('productos.administration.edit')->middleware('can:edit.products.dash');
            Route::put('/{product}/update', [ProductController::class, 'update'])
                ->name('productos.administration.update')->middleware('can:edit.products.dash');

            Route::post('/destroy', [ProductController::class, 'destroy'])
                ->name('productos.administration.destroy')->middleware('can:destroy.products.dash');
    });
// Productos

// Facturas
    Route::group(
        [
            'middleware' => ['auth', 'can:see.bills'],
            'prefix' => 'administration/facturas'
        ], function (){
            Route::get('/', [BillController::class, 'index'])
                ->name('bills');

            Route::get('/create', [BillController::class, 'create'])
                ->name('bills.create')
                ->middleware('can:see.bills');

            Route::post('/store', [BillController::class, 'store'])
                ->name('bills.store')
                ->middleware('can:create.bills');

            Route::get('/{referencia}', [BillController::class, 'show'])
                ->name('bills.bill');

            Route::get('/{referencia}/edit', [BillController::class, 'edit'])
                ->name('bills.edit')
                ->middleware('can:edit.bills');

            Route::put('/{product}/update', [BillController::class, 'update'])
                ->name('bills.update')
                ->middleware('can:edit.bills');

            Route::post('/destroy', [BillController::class, 'destroy'])
                ->name('bills.destroy')
                ->middleware('can:destroy.bills');
    });
// Facturas

// Ecommerce
    Route::get('/', [PageController::class, 'index'])->name('home');
    Route::get('/home', [PageController::class, 'index'])->name('home');
    Route::get('/{slug}/p/', [PageController::class, 'show'])->name('producto.producto');
    Route::get('/{category}/c/', [PageController::class, 'category'])->name('category.productos');
    Route::get('/catalogo', [PageController::class, 'catalogo'])->name('catalogo');
// Ecommerce

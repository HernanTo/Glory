<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);

Route::get('/administration', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('can:getInto.administration');
Route::post('/check-auth', [PageController::class, 'check'])->name('check.auth');

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

            Route::get('/{referencia}/export', [BillController::class, 'export'])
                ->name('bills.export')
                ->middleware('can:see.bills');

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

// Cotizaciones
    Route::group(
        [
            'middleware' => ['auth', 'can:see.budgets'],
            'prefix' => 'administration/cotizaciones'
        ], function (){
            Route::get('/', [BudgetController::class, 'index'])
                ->name('budgets');

            Route::get('/create', [BudgetController::class, 'create'])
                ->name('budgets.create')
                ->middleware('can:see.budgets');

            Route::post('/store', [BudgetController::class, 'store'])
                ->name('budgets.store')
                ->middleware('can:create.budgets');

            Route::get('/{referencia}', [BudgetController::class, 'show'])
                ->name('budgets.budget');

            Route::get('/{referencia}/export', [BudgetController::class, 'export'])
                ->name('budgets.export')
                ->middleware('can:see.budgets');

            Route::get('/{referencia}/edit', [BudgetController::class, 'edit'])
                ->name('budgets.edit')
                ->middleware('can:edit.budgets');

            Route::put('/{product}/update', [BudgetController::class, 'update'])
                ->name('budgets.update')
                ->middleware('can:edit.budgets');

            Route::post('/destroy', [BudgetController::class, 'destroy'])
                ->name('budgets.destroy')
                ->middleware('can:destroy.budgets');
    });
// Cotizaciones

// CMS
    Route::controller(ContentController::class)->prefix('administration/cms')->middleware('auth', 'can:getInto.administration')->group(function (){
        Route::get('/', 'index')->name('cms');
        Route::post('/create', 'store')->name('cms.create');
        Route::delete('/delete', 'destroy')->name('cms.delete');
    });
// CMS

// Blogs Administration
    Route::group(
        [
            'middleware' => ['auth', 'can:see.blog.administration'],
            'prefix' => 'administration/blog'
        ], function (){
            Route::get('/', [BlogController::class, 'index'])
                    ->name('blog.administration');
            Route::get('/create', [BlogController::class, 'create'])
                    ->name('blog.administration.create')
                    ->middleware('can:create.blog.administration');
            Route::post('/store', [BlogController::class, 'store'])
                    ->name('blog.administration.store')
                    ->middleware('can:create.blog.administration');

            Route::get('/{slug}', [BlogController::class, 'show'])
            ->name('blog.administration.show')
            ->middleware('can:see.blog.administration');

            Route::get('/{slug}/edit', [BlogController::class, 'edit'])
            ->name('blog.administration.edit')
            ->middleware('can:update.blog.administration');


            Route::put('/{slug}/update', [BlogController::class, 'update'])
            ->name('blog.administration.update')
            ->middleware('can:update.blog.administration');

            Route::post('/destroy', [BlogController::class, 'destroy'])
            ->name('blog.administration.destroy')
            ->middleware('can:destroy.blog.administration');
    });
// Blogs Administration

// Blogs
    Route::controller(PostController::class)->prefix('/blog')->group(function (){
        Route::get('/', 'index')->name('blog');
        Route::get('/{slug}', 'show')->name('blog.show');
    });
// Blogs

// Ecommerce
    Route::get('/', [PageController::class, 'index'])->name('home');
    Route::get('/{slug}/p/', [PageController::class, 'show'])->name('producto.producto');
    Route::get('/{category}/c/', [PageController::class, 'category'])->name('category.productos');
    Route::get('/catalogo', [PageController::class, 'catalogo'])->name('catalogo');
    Route::get('/tiendas', [PageController::class, 'stores'])->name('tiendas');
    Route::get('/autocomplete', [PageController::class, 'search'])->name('search.eco');
    Route::get('/search', [PageController::class, 'searchProducts'])->name('search.products.eco');
    Route::get('/profileGeneral', [PageController::class, 'profile'])->name('profileGeneral');
// Ecommerce

// Carrito
    Route::controller(ShoppingCartController::class)->prefix('/carrito')->group(function (){
        Route::get('/', 'index')->name('carrito');
        Route::post('/show', 'show')->name('carrito.show')->middleware('can:getIntoViews.User');
        Route::post('/add', 'store')->name('carrito.add');
        Route::post('/destroy', 'destroy')->name('carrito.destroy');
        Route::post('/destroy/c', 'destroyForm')->name('carrito.destroy.c');
        Route::put('/update', 'update')->name('carrito.update');
        // Route::get('/producto/temp', 'index')->name('carrito.prod.temp');
    });
// Carrito

// Settings
    Route::group(
        [
            'middleware' => ['auth', 'can:getInto.administration'],
            'prefix' => 'administration/settings'
        ], function (){
            Route::get('/profile', [ProfileController::class, 'index'])
            ->name('settings');

            Route::put('/profile/update', [ProfileController::class, 'update'])
            ->name('settings.profile.update');

            Route::get('/categorias', [ProfileController::class, 'category'])
            ->name('settings.category');
            Route::get('/categorias/deshabilitadas', [ProfileController::class, 'categoryDes'])
            ->name('settings.category.des');

            Route::post('/categorias/store', [CategoryController::class, 'store'])
            ->name('category.store');

            Route::post('/categorias/destroy', [CategoryController::class, 'destroy'])
            ->name('category.destroy');

            Route::post('/categorias/enable', [CategoryController::class, 'enable'])
            ->name('category.enable');
    });
// Settings

// User ecommerce
    Route::group(
        [
            'prefix' => 'perfil',
            'middleware' => ['auth', 'can:getIntoViews.User', 'verified']
        ], function (){
            Route::get('/', [ProfileController::class, 'profile'])->name('profile');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
    });
// User ecommerce
// Resume shopping
    Route::controller(OrderController::class)
        ->middleware('auth', 'can:getIntoViews.User', 'verified')
        ->group(function(){
            Route::get('perfil/compras', 'index')->name('compras');
        }
    );
// Resume shopping

// Password
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password')->middleware('auth');
// Password

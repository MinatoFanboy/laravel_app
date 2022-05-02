<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Users\LoginController;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('main', [AdminController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function() {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::delete('destroy', [MenuController::class, 'destroy']);
        });

        #Product
        Route::prefix('products')->group(function() {
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::delete('destroy', [ProductController::class, 'destroy']);
        });

        #Slider
        Route::prefix('sliders')->group(function() {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::delete('destroy', [SliderController::class, 'destroy']);
        });

        #Order
        Route::prefix('customer')->group(function() {
            Route::get('/', [App\Http\Controllers\Admin\CartController::class, 'index']);
            Route::get('/view/{customer}', [App\Http\Controllers\Admin\CartController::class, 'show']);
        });

        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});

Route::get('/', [MainController::class, 'index']);
Route::post('/services/load-product', [MainController::class, 'loadProduct']);
Route::get('/danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('/san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('/add-cart', [CartController::class, 'index']);
Route::get('/carts.html', [CartController::class, 'show']);
Route::post('/carts.html', [CartController::class, 'addCart']);
Route::post('/update-cart', [CartController::class, 'update']);
Route::get('/carts/delete/{id}', [CartController::class, 'remove']);

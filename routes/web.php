<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::get('main', [MainController::class, 'index'])->name('admin');

    Route::prefix('menus')->group(function () {
        Route::get('add', [MenuController::class, 'create']);
        Route::post('add', [MenuController::class, 'store']);
        Route::get('list', [MenuController::class, 'index']);
        Route::get('edit/{menu}', [MenuController::class, 'show']);
        Route::post('edit/{menu}', [MenuController::class, 'update']);
        Route::get('destroy/{menu}', [MenuController::class, 'destroy']);
    });

    Route::prefix('products')->group(function () {
        Route::get('add', [ProductController::class, 'create']);
        Route::post('add', [ProductController::class, 'store']);
        Route::get('list', [ProductController::class, 'index'])->name("t");
        Route::get('edit/{id}', [ProductController::class, 'show'])->name("product.edit");
        Route::post('edit/{product}', [ProductController::class, 'update']);
        Route::get('destroy/{product}', [ProductController::class, 'destroy'])->name("product.delete");
    });

    Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
});

Route::get('/homepage', [\App\Http\Controllers\MainController::class, 'index']);
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);

Route::prefix('category')->group(function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'show']);
});
Route::prefix('product')->group(function () {
    Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('home.product.view');
});
Route::get('category/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('product/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);

Route::post('add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('carts', [App\Http\Controllers\CartController::class, 'show']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('carts', [App\Http\Controllers\CartController::class, 'addCart']);
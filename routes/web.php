<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{product}', [ShopController::class, 'show'])->name('show');
    Route::post('/{product}/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::get('/order/{order}/success', [ShopController::class, 'success'])->name('order.success');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('upload/image', [App\Http\Controllers\Admin\UploadController::class, 'image'])->name('upload.image');
    Route::resource('products', AdminProductController::class);
    Route::delete('products/{product}/image/{index}', [AdminProductController::class, 'deleteImage'])->name('products.deleteImage');
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'password'])->name('profile.password');
});

require __DIR__.'/auth.php';

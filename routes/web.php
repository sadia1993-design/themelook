<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
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
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->controller(RegisteredUserController::class)->middleware(['auth'])->group(function () {
    Route::get('/user', 'index')->name('user');
    Route::get('/user/destroy/{id}', 'destroy')->name('user.destroy');
    Route::get('/user/{id}/edit', 'edit')->name('user.edit');
    Route::post('/user/{id}/update', 'update')->name('user.update');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::resource('product', ProductController::class);
    Route::get('product/variants/{id}', [ProductVariantController::class, 'index'])
        ->name('product.variants');

    Route::delete('product/variants/{id}/delete', [ProductVariantController::class, 'destroy'])
        ->name('productVariant.destroy');
    Route::put('product/variants/{id}/update', [ProductVariantController::class, 'update'])
        ->name('productVariant.update');

});
require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductManagementController;
use App\Http\Controllers\RegistrationController;
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
    return view('home');
})->name('home');

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/register', 'create')->middleware('guest');
    Route::post('/register', 'store')->middleware('guest');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->middleware('guest');
    Route::post('/login', 'login')->middleware('guest');
    Route::get('/logout', 'logout')->middleware('auth');
});


Route::controller(AccountSettingsController::class)->group(function () {
    Route::get('/account-settings', 'edit')->middleware('auth');
    Route::put('/account-settings', 'update')->middleware('auth');
});

Route::controller(CategoryController::class)->group(function () {
    Route::post('/category', 'store')->middleware('auth.admin');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth.admin');

Route::controller(ProductManagementController::class)->group(function () {
    Route::get('/manage-product', 'index')->middleware('auth.admin');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('/manage-product', 'store')->middleware('auth.admin');
});

//Route::get('/manage-product', function () {
//    return view('admin.manage-product');
//});

Route::get('/manage-product-order', function () {
    return view('admin.manage-product-order');
});

Route::get('/manage-service-order', function () {
    return view('admin.manage-service-order');
});

Route::get('/manage-technician', function () {
    return view('admin.manage-technician');
});




Route::get('/search', function () {
    return view('search');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/payment', function () {
    return view('payment');
});

Route::get('/service-order', function () {
    return view('service-order');
});

Route::get('/order-history-product', function () {
    return view('order-history-product');
});

Route::get('/order-history-service  ', function () {
    return view('order-history-service  ');
});

Route::get('/track', function () {
    return view('track');
});

Route::get('/confirm-service-availability', function () {
    return view('technician.confirm-service-availability');
});


Route::get('/test', function () {
    return view('playground._test-pg', [
        "name" => "oni",
        "email" => "oni@oni.com"
    ]);
});

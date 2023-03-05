<?php

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

Route::get('/order-history', function () {
    return view('order-history');
});

Route::get('/track', function () {
    return view('track');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/account-settings', function () {
    return view('account-settings');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/manage-product', function () {
    return view('admin.manage-product');
});

Route::get('/manage-product-order', function () {
    return view('admin.manage-product-order');
});

Route::get('/manage-service-order', function () {
    return view('admin.manage-service-order');
});

Route::get('/manage-technician', function () {
    return view('admin.manage-technician');
});


Route::get('/test', function () {
    return view('_test-pg', [
        "name" => "oni",
        "email" => "oni@oni.com"
    ]);
});

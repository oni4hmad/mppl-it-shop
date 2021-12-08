<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

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

Route::get('/order-history-product', function () {
    return view('order-history-product');
});

Route::get('/order-history-service', function () {
    return view('order-history-service');
});

Route::get('/track', function () {
    return view('track');
});

Route::get('/register-oni', function () {
    return view('register-oni');
});

Route::get('/account-settings', function () {
    return view('account-settings');
});

Route::get('/service-order', function () {
    return view('service-order');
});


// admin
Route::get('/manage-product', function () {
    return view('admin/manage-product');
});


Route::get('/test', function () {
    return view('_test-pg', [
        "name" => "oni",
        "email" => "oni@oni.com"
    ]);
});

Auth::routes();

Route::get('admin/home', [ProductController::class, 'products'])->name('admin.home')->middleware('is_admin');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/add-product',[ProductController::class, 'addProduct'])->middleware('is_admin');
Route::post('/add-product',[ProductController::class, 'storeProduct'])->name('product.store')->middleware('is_admin');

Route::get('/edit-product/{id}',[ProductController::class, 'editProduct'])->middleware('is_admin');
Route::put('/update-student',[ProductController::class, 'updateProduct'])->name('product.update')->middleware('is_admin');

Route::get('/delete-product/{id}',[ProductController::class,'deleteProduct'])->middleware('is_admin');
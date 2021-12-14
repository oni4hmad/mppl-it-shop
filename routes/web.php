<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UpdateProfileInformationController;

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

// Route::get('/product', function () {
//     return view('product');
// });

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

Route::get('/account-settings', [UpdateProfileInformationController::class, 'edit'])->name('profile.edit');

Route::put('/name-updates', [UpdateProfileInformationController::class, 'updateName'])->name('profile.updateName');
Route::put('/email-updates', [UpdateProfileInformationController::class, 'updateEmail'])->name('profile.updateEmail');
Route::put('/no_hp-updates', [UpdateProfileInformationController::class, 'updateNoHp'])->name('profile.updateNoHp');
Route::put('/alamat-updates', [UpdateProfileInformationController::class, 'updateAlamat'])->name('profile.updateAlamat');
Route::put('/password-updates', [UpdateProfileInformationController::class, 'updatePassword'])->name('profile.updatePassword');
Route::put('/image-updates', [UpdateProfileInformationController::class, 'updateImage'])->name('profile.updateImage');



Route::get('/service-order', function () {
    return view('service-order');
});


// admin
// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// });

// Route::get('/manage-product', function () {
//     return view('admin/manage-product');
// })->miff;

Route::get('/manage-technician', function () {
    return view('admin/manage-technician');
});

Route::get('/manage-product-order', function () {
    return view('admin/manage-product-order');
});

Route::get('/manage-service-order', function () {
    return view('admin/manage-service-order');
});

Route::get('/confirm-service-availability', function () {
    return view('technician/confirm-service-availability');
});

// test: coba blade
Route::get('/test', function () {
    return view('test/_test-pg', [
        "name" => "oni",
        "email" => "oni@oni.com"
    ]);
});

Auth::routes();
Route::get('/dashboard', [HomeController::class, 'adminHome'])->middleware('is_admin');
Route::get('/manage-product', [ProductController::class, 'products'])->name('admin.home')->middleware('is_admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/add-product',[ProductController::class, 'addProduct'])->middleware('is_admin');
Route::post('/add-product',[ProductController::class, 'storeProduct'])->name('product.store')->middleware('is_admin');

Route::get('/edit-product/{id}',[ProductController::class, 'editProduct'])->middleware('is_admin');
Route::put('/update-student',[ProductController::class, 'updateProduct'])->name('product.update')->middleware('is_admin');

Route::get('/delete-product/{id}',[ProductController::class,'deleteProduct'])->middleware('is_admin');

Route::get('/search', [ProductController::class, 'userProducts']);
Route::get('/product/{id}', [ProductController::class, 'productDetail']);

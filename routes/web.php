<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\login_registerController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\shoppingCartController;
use App\Models\login_register;
Route::get('/search',[HomeController::class, "search"]);
Route::get('/vouchers', [VoucherController::class, "index"]);
Route::get('', [HomeController::class, "index"]);
Route::post('/product/create', [ProductController::class, "create"]);
Route::get('/login', [login_registerController::class, "index"]);
Route::get('/register', [login_registerController::class, "index"]);
Route::get('/product-details', [DetailProductController::class, "index"]);
// Route::method('/đường dẫn',[Tên controller::class, "Function thực hiện trả về view nằm ở Controller"]);
Route::get('/create', [ProductController::class, "create"])->name('product.create');
Route::post('/save', [ProductController::class, "save"])->name('product.save');
Route::put('/product-management/update/{id}', [ProductController::class, 'update']);
Route::get('/best-seller', [ProductController::class, "filterProducts"]);
Route::post('/register', [login_registerController::class, "register"]);
Route::post('/login', [login_registerController::class, "login"]);
Route::get('/logout', [login_registerController::class, "logout"]);
Route::post('/add-to-cart', [shoppingCartController::class, "index"]);
Route::get('/cart', [shoppingCartController::class, "getToCart"]);
Route::get('/new-products', [ProductController::class, "getNewProduct"]);
Route::get('/fillter', [ProductController::class, "filterProducts"]);

Route::get('/profile', [HomeController::class, "profileUser"]);
Route::put('/edit-profile', [HomeController::class, "editProfileUser"]);


Route::prefix("/admin")->group(function () {
    Route::delete('/product/delete', [ProductController::class, "delete"]);
    Route::post('/voucher-management/create', [AdminController::class, "voucherManagementCreate"]);
    Route::delete('/voucher-management/delete', [AdminController::class, "voucherManagementDelete"]);
    Route::put('/voucher-management/update/{id}', [AdminController::class, "voucherManagementUpdate"]);
    Route::get('/profile', [AdminController::class, "profileView"]);
    Route::put('/profile', [AdminController::class, "updateProfile"]);
    Route::put('/edit-profile', [AdminController::class, "editProfileAdmin"]);
    Route::get('/admin', [AdminController::class, "userManagement"]);
    Route::post('/user-management/create', [AdminController::class, "create"]);
    Route::get('/user-management', [AdminController::class, "userManagement"]);
    Route::delete('/user-management/delete', [AdminController::class, "delete"]);
    Route::put('/user-management/update/{id}', [AdminController::class, "update"]);
    Route::get('/product-management', [AdminController::class, "productManagement"]);
    Route::get('/voucher-management', [AdminController::class, "voucherManagement"]);
    Route::get('/statistics', [AdminController::class, "statistics"]);
});

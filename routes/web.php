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

Route::get('/vouchers', [VoucherController::class, "index"]);
Route::get('', [HomeController::class, "index"]);
Route::post('/product/create', [ProductController::class, "create"]);
Route::get('/login', [login_registerController::class, "index"]);
Route::get('/register', [login_registerController::class, "index"]);
Route::get('/detailproduct', [DetailProductController::class, "index"]);
// Route::method('/đường dẫn',[Tên controller::class, "Function thực hiện trả về view nằm ở Controller"]);

Route::get('/admin', [AdminController::class, "userManagement"]);
Route::post('/userManagement/create', [AdminController::class, "create"]);
Route::get('/userManagement', [AdminController::class, "userManagement"]);
Route::delete('/userManagement/delete', [AdminController::class, "delete"]);
Route::put('/userManagement/update/{id}', [AdminController::class, "update"]);
Route::get('/productManagement', [AdminController::class, "productManagement"]);
Route::get('/voucherManagement', [AdminController::class, "voucherManagement"]);
Route::get('/showChartManagement', [AdminController::class, "showChartManagement"]);
Route::delete('/product/delete', [ProductController::class, "delete"]);
Route::get('/create', 'ProductController@create')->name('product.create');
Route::post('/save', 'ProductController@save')->name('product.save');
Route::put('/productManagement/update/{id}', [ProductController::class, 'updateP']);
Route::post('/register/register', [login_registerController::class, "register"]);
Route::post('/login/login', [login_registerController::class, "login"]);
Route::get('/logout', [login_registerController::class, "logout"]);
Route::get('/cart', [shoppingCartController::class, "index"]);



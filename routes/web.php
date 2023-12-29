<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\login_registerController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailProductController;

Route::get('/vouchers', [VoucherController::class, "index"]);
Route::get('', [HomeController::class, "index"]);
Route::post('/product/create', [ProductController::class, "create"]);
Route::get('/login', [login_registerController::class, "index"]);
Route::get('/register', [login_registerController::class, "index"]);
Route::get('/detailproduct', [DetailProductController::class, "index"]);
// Route::method('/đường dẫn',[Tên controller::class, "Function thực hiện trả về view nằm ở Controller"]);

Route::get('/admin', [AdminController::class, "userManagement"]);
Route::get('/userManagement', [AdminController::class, "userManagement"]);
Route::get('/productManagement', [AdminController::class, "productManagement"]);
Route::get('/voucherManagement', [AdminController::class, "voucherManagement"]);
Route::get('/showChartManagement', [AdminController::class, "showChartManagement"]);
Route::delete('/product/delete', [ProductController::class, "delete"]);
Route::get('/create', 'ProductController@create')->name('product.create');
Route::post('/save', 'ProductController@save')->name('product.save');
Route::put('/productManagement/update/{id}', [ProductController::class, 'updateP']);



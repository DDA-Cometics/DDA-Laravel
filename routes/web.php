<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\login_registerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;

Route::get('/vouchers', [VoucherController::class, "index"]);
Route::get('', [HomeController::class, "index"]);
Route::post('/product/create', [ProductController::class, "create"]);
Route::get('/login', [login_registerController::class, "index"]);
Route::get('/register', [login_registerController::class, "index"]);
// Route::method('/đường dẫn',[Tên controller::class, "Function thực hiện trả về view nằm ở Controller"]);
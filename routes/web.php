<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\login_registerController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\shoppingCartController;
use App\Http\Controllers\checkoutController;

    Route::get('/search',[HomeController::class, "search"]);
    Route::get('/vouchers', [VoucherController::class, "index"]);
    Route::get('', [HomeController::class, "index"]);
    Route::get('/login', [login_registerController::class, "index"]);
    Route::get('/register', [login_registerController::class, "index"]);
    Route::get('/product-details', [DetailProductController::class, "index"]);
    Route::get('/create', [ProductController::class, "create"])->name('product.create');
    Route::post('/save', [ProductController::class, "save"])->name('product.save');
    Route::get('/best-seller', [ProductController::class, "filterProducts"]);
    Route::post('/register', [login_registerController::class, "register"]);
    Route::post('/login', [login_registerController::class, "login"]);
    Route::get('/logout', [login_registerController::class, "logout"]);
    Route::post('/add-to-cart', [shoppingCartController::class, "index"]);
    Route::delete('/add-to-cart', [shoppingCartController::class, "deleteProductToCart"]);
    Route::get('/cart', [shoppingCartController::class, "getToCart"]);
    Route::get('/new-products', [ProductController::class, "getNewProduct"]);
    Route::get('/fillter', [ProductController::class, "filterProducts"]);
    Route::get('/profile', [HomeController::class, "profileUser"]);
    Route::put('/edit-profile', [HomeController::class, "editProfileUser"]);
    Route::post('/payUrl', [checkoutController::class, "paymentMomo"]);
    Route::get('/ordered', [checkoutController::class, "ordered"]);
    Route::get('/history', [checkoutController::class, "history"]);

    Route::prefix("/admin")->group
    (
        function () 
        {
            Route::get('/new-products', [ProductController::class, "getNewProduct"]);
            Route::get('/best-seller', [ProductController::class, "filterProducts"]);
            Route::get('/history', [checkoutController::class, "history"]);
            Route::get('/cart', [shoppingCartController::class, "getToCart"]);
            Route::get('/login', [login_registerController::class, "index"]);
            Route::post('/product/create', [ProductController::class, "create"]);
            Route::put('/product-management/update/{id}', [ProductController::class, 'update']);
            Route::put('/product/delete', [ProductController::class, "delete1"]);
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
            Route::get('/more-table', [AdminController::class, "moreTable"]);
            Route::post('/more-table/voucher-management-applied-create', [AdminController::class, "voucherManagementAppliedCreate"]);
            Route::put('/more-table/voucher-management-applied-update/{id}', [AdminController::class, "voucherManagementAppliedUpdate"]);
            Route::delete('/more-table/voucher-management-applied-delete/{id}', [AdminController::class, "voucherManagementAppliedDelete"]);
            Route::post('/more-table/order-management-create', [AdminController::class, "orderManagementCreate"]);
            Route::put('/more-table/order-management-update/{id}', [AdminController::class, "orderManagementUpdate"]);
            Route::delete('/more-table/order-management-delete/{id}', [AdminController::class, "orderManagementDelete"]);
            Route::post('/more-table/order-detail-management-create', [AdminController::class, "orderDetailManagementCreate"]);
            Route::put('/more-table/order-detail-management-update/{id}', [AdminController::class, "orderDetailManagementUpdate"]);
            Route::delete('/more-table/order-detail-management-delete/{id}', [AdminController::class, "orderDetailManagementDelete"]);
            Route::post('/more-table/payment-history-management-create', [AdminController::class, "paymentHistoryManagementCreate"]);
            Route::put('/more-table/payment-history-management-update/{id}', [AdminController::class, "paymentHistoryManagementUpdate"]);
            Route::delete('/more-table/payment-history-management-delete/{id}', [AdminController::class, "paymentHistoryManagementDelete"]);
        }
    );
    Route::get('/clear-all-cache', function() {
        Artisan::call('cache:clear');
      
        dd("Cache Clear All");
    });
?>
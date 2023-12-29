<?php

namespace App\Http\Controllers;
use App\Services\Interfaces\IAdminService;
use Illuminate\Support\Facades\Validator;

// use App\Services\Interfaces\IProductService;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(
        private IAdminService $AdminService,
        // private IProductService $productService
        )
    {}

    function productManagement()
    {
        $product = $this->AdminService->getProduct();
        return view("pages.admin.product", ["products" => $product]);
    }
    function userManagement()
    {
        $user = $this->AdminService->getUser();
        return view("pages.admin.user", ["users" => $user]);
    }
    function voucherManagement()
    {
        $voucher = $this->AdminService->getVoucher();
        return view("pages.admin.voucher", ["vouchers" => $voucher]);
    }
    function showChartManagement()
    {
        return view("pages.admin.showchart");
    }
}
<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IVoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    function __construct(
        private IVoucherService $voucherService
    )
    {}
    function index() {
        $vouchers = $this->voucherService->getAllActiveVouchers();
        return view("vouchers/index", ["vouchers" => $vouchers]);
    }     
}
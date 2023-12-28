<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\IAdminService;
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
    function create(Request $request){
        //Insert product into database
        $data= $request->all();
        $this->AdminService->create($data);
        // Store the user...
        return redirect('/userManagement');
    }
    function delete(Request $id){
        // Lấy dữ liệu từ request, ví dụ trường 'id'
        $userIdToDelete = $id->all();
        // Gọi hàm delete từ AdminService để xóa người dùng
        $this->AdminService->delete($userIdToDelete);

        return redirect('/userManagement');
    }
    function update(Request $id, Request $attributes){
        // Lấy dữ liệu từ request, ví dụ trường 'id'
        $userIdToUpdate = $id->all();
        $data = $attributes->all();

        // Gọi hàm delete từ AdminService để xóa người dùng
        $this->AdminService->update($userIdToUpdate, $data);

        return redirect('/userManagement');
    }   
}
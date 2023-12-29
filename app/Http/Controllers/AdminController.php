<?php

namespace App\Http\Controllers;
use App\Services\Interfaces\IAdminService;
use Illuminate\Support\Facades\Validator;


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
        $validator = Validator::make($request->all(), [
            'image' => 'required|url',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string',
            'account_name' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|max:255',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect('/productManagement') // Điều hướng nếu dữ liệu không hợp lệ
                ->withErrors($validator)
                ->withInput();
        }
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
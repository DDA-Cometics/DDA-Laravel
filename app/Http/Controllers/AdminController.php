<?php

namespace App\Http\Controllers;
use App\Services\Interfaces\IAdminService;
use App\Services\Interfaces\IVoucherService;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(
        private IAdminService $AdminService,
        private IVoucherService $VoucherService,
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
            return redirect('/userManagement') // Điều hướng nếu dữ liệu không hợp lệ
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
    function update(Request $request){
        // // Lấy dữ liệu từ request, ví dụ trường 'id'
        // $userIdToUpdate = $id;
        // $data = $attributes->all();

        // // Gọi hàm delete từ AdminService để xóa người dùng
        // $this->AdminService->update($userIdToUpdate, $data);

        // return redirect('/userManagement');
        // Lấy dữ liệu từ request, ví dụ trường 'id'
    $userIdToUpdate = $request->input('id');

    // Lấy các trường cần cập nhật từ request
    $data = $request->except(['_token', '_method', 'id']);

    // Gọi hàm update từ AdminService để cập nhật người dùng
    $this->AdminService->update($userIdToUpdate, $data);

    return redirect('/userManagement');
    }
    function voucherManagementCreate(Request $request){
        // $validator = Validator::make($request->all(), [
        //     'description' => 'required|string',
        //     'discount' => 'required|number',
        //     'active_datetime' => 'required|date',
        //     'expired_datetime' => 'required|date',
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/voucherManagement') // Điều hướng nếu dữ liệu không hợp lệ
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        //Insert product into database
        $data= $request->all();
        $this->VoucherService->createVoucher($data);
        // Store the user...
        return redirect('/voucherManagement');
    }
    function voucherManagementDelete(Request $id){
        // Lấy dữ liệu từ request, ví dụ trường 'id'
        $voucherIdToDelete = $id->all();
        // Gọi hàm delete từ AdminService để xóa người dùng
        $this->VoucherService->deleteVoucher($voucherIdToDelete);

        return redirect('/voucherManagement');
    }
    function voucherManagementUpdate(Request $request){
        // // Lấy dữ liệu từ request, ví dụ trường 'id'
        // $userIdToUpdate = $id;
        // $data = $attributes->all();

        // // Gọi hàm delete từ AdminService để xóa người dùng
        // $this->AdminService->update($userIdToUpdate, $data);

        // return redirect('/userManagement');
        // Lấy dữ liệu từ request, ví dụ trường 'id'
    $userIdToUpdate = $request->input('id');

    // Lấy các trường cần cập nhật từ request
    $data = $request->except(['_token', '_method', 'id']);

    // Gọi hàm update từ AdminService để cập nhật người dùng
    $this->VoucherService->updateVoucher($userIdToUpdate, $data);

    return redirect('/voucherManagement');
    }
}
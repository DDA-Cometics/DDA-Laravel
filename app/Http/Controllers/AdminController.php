<?php

namespace App\Http\Controllers;
use App\Services\Interfaces\IAdminService;
use App\Services\Interfaces\IVoucherService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




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
    function statistics()
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
            return redirect('/admin/user-management') // Điều hướng nếu dữ liệu không hợp lệ
                ->withErrors($validator)
                ->withInput();
        }
        //Insert product into database
        $data= $request->all();
        $this->AdminService->create($data);
        // Store the user...
        return redirect('/admin/user-management');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/user-management')
                ->withErrors($validator)
                ->withInput();
        }

        $userIdToUpdate = $request->input('id');
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');

        try {
            // Kiểm tra mật khẩu cũ
            $user = User::find($userIdToUpdate);

            if (!$user) {
                // Người dùng không tồn tại
                throw new \Exception('Người dùng không tồn tại');
            }

            if (Hash::check($oldPassword, $user->password)) {
                // Mật khẩu cũ đúng, cập nhật mật khẩu mới
                $this->AdminService->updatePassword($userIdToUpdate, $newPassword);
                return redirect('/admin/profileuser')->with('success', 'Mật khẩu đã được cập nhật thành công');
            } else {
                // Mật khẩu cũ không đúng
                throw new \Exception('Mật khẩu cũ không đúng');
            }
        } catch (\Exception $e) {
            return redirect('/admin/profileadmin')->with('error', $e->getMessage());
        }
    }
    function profileView()
    {
        return view("pages.Profile.profileadmin");
    }

    function delete(Request $id){
        // Lấy dữ liệu từ request, ví dụ trường 'id'
        $userIdToDelete = $id->all();
        // Gọi hàm delete từ AdminService để xóa người dùng
        $this->AdminService->delete($userIdToDelete);

        return redirect('/admin/user-management');
    }
    function update(Request $request){
        // // Lấy dữ liệu từ request, ví dụ trường 'id'
        // $userIdToUpdate = $id;
        // $data = $attributes->all();

        // // Gọi hàm delete từ AdminService để xóa người dùng
        // $this->AdminService->update($userIdToUpdate, $data);

        // return redirect('/user-management');
        // Lấy dữ liệu từ request, ví dụ trường 'id'
    $userIdToUpdate = $request->input('id');

    // Lấy các trường cần cập nhật từ request
    $data = $request->except(['_token', '_method', 'id']);

    // Gọi hàm update từ AdminService để cập nhật người dùng
    $this->AdminService->update($userIdToUpdate, $data);

    return redirect('/admin/user-management');
    }
    function voucherManagementCreate(Request $request){
        // $validator = Validator::make($request->all(), [
        //     'description' => 'required|string',
        //     'discount' => 'required|number',
        //     'active_datetime' => 'required|date',
        //     'expired_datetime' => 'required|date',
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/voucher-management') // Điều hướng nếu dữ liệu không hợp lệ
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        //Insert product into database
        $data= $request->all();
        $this->VoucherService->createVoucher($data);
        // Store the user...
        return redirect('/admin/voucher-management');
    }
    function voucherManagementDelete(Request $id){
        // Lấy dữ liệu từ request, ví dụ trường 'id'
        $voucherIdToDelete = $id->all();
        // Gọi hàm delete từ AdminService để xóa người dùng
        $this->VoucherService->deleteVoucher($voucherIdToDelete);

        return redirect('/admin/voucher-management');
    }
    function voucherManagementUpdate(Request $request){
        // // Lấy dữ liệu từ request, ví dụ trường 'id'
        // $userIdToUpdate = $id;
        // $data = $attributes->all();

        // // Gọi hàm delete từ AdminService để xóa người dùng
        // $this->AdminService->update($userIdToUpdate, $data);

        // return redirect('/user-management');
        // Lấy dữ liệu từ request, ví dụ trường 'id'
    $userIdToUpdate = $request->input('id');

    // Lấy các trường cần cập nhật từ request
    $data = $request->except(['_token', '_method', 'id']);

    // Gọi hàm update từ AdminService để cập nhật người dùng
    $this->VoucherService->updateVoucher($userIdToUpdate, $data);

    return redirect('/admin/voucher-management');
    }
}
<?php

namespace App\Http\Controllers;
use App\Services\Interfaces\IAdminService;
use App\Services\Interfaces\IVoucherService;
use App\Services\Interfaces\IUserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\IProductService;
use App\Models\Payment_history;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(
        private IAdminService $AdminService,
        private IVoucherService $VoucherService,
        private IProductService $ProductService,
        private IUserService $UserService,
        )
    {}

    function productManagement()
    {
        $sessionData = session()->get('user_data');
        if (!$sessionData || !isset($sessionData['id'])) {
            return view("pages.login.index");
        }
        $role = $sessionData['role'];
        if ($role != "admin") {
            return redirect("/");
        }

        $product = $this->AdminService->getProduct();
        return view("pages.admin.product", ["products" => $product]);
    }
    function userManagement()
    {
        $sessionData = session()->get('user_data');
        if (!$sessionData || !isset($sessionData['id'])) {
            return view("pages.login.index");
        }
        $role = $sessionData['role'];
        if ($role != "admin") {
            return redirect("/");
        }

        $user = $this->AdminService->getUser();
        return view("pages.admin.user", ["users" => $user]);
    }
    function voucherManagement()
    {
        $sessionData = session()->get('user_data');
        if (!$sessionData || !isset($sessionData['id'])) {
            return view("pages.login.index");
        }
        $role = $sessionData['role'];
        if ($role != "admin") {
            return redirect("/");
        }
        $voucher = $this->AdminService->getVoucher();
        return view("pages.admin.voucher", ["vouchers" => $voucher]);
    }
    function statistics()
    {
        $sessionData = session()->get('user_data');
        $userId = $sessionData['id'] ?? 0;
        $role = $sessionData['role'];
        if ($userId ===0){
            return view("pages.login.index");
        }
        if ($role != "admin"){
            return redirect("/");
        }
        $data = Payment_history::select(
            DB::raw('DATE(created_at) as date'), 
            DB::raw('COUNT(*) as order_count'), 
            DB::raw('SUM(amount) as total_amount'))
            ->groupBy('date')
            ->get();
        return view("pages.admin.showchart",compact('data'));
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
            return redirect('/admin/user-management') 
                ->withErrors($validator)
                ->withInput();
        }
        $data= $request->all();
        $this->AdminService->create($data);
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
            $user = $this->UserService->find($userIdToUpdate);
            if (!$user) {
                throw new \Exception('Người dùng không tồn tại');
            }

            if (Hash::check($oldPassword, $user->password)) {
                $this->AdminService->updatePassword($userIdToUpdate, $newPassword);
                return redirect('/admin/profileuser')->with('success', 'Mật khẩu đã được cập nhật thành công');
            } else {
                throw new \Exception('Mật khẩu cũ không đúng');
            }
        } catch (\Exception $e) {
            return redirect('/admin/profileadmin')->with('error', $e->getMessage());
        }
    }
    function profileView()
    {
        $sessionData = session()->get('user_data');
        if (!$sessionData || !isset($sessionData['id'])) {
            return view("pages.login.index");
        }
        $role = $sessionData['role'];
        if ($role != "admin") {
            return redirect("/");
        }
        return view("pages.Profile.profileadmin");
    }

    function delete(Request $id)
    {
        $userIdToDelete = $id->all();
        $this->AdminService->delete($userIdToDelete);
        return redirect('/admin/user-management');
    }
    function update(Request $request)
    {
        $userIdToUpdate = $request->input('id');

        $data = $request->except(['_token', '_method', 'id']);

        $this->AdminService->update($userIdToUpdate, $data);

        return redirect('/admin/user-management');
    }
    function voucherManagementCreate(Request $request)
    {
        $data= $request->all();
        $this->VoucherService->createVoucher($data);
        return redirect('/admin/voucher-management');
    }
    function voucherManagementDelete(Request $id)
    {      
        $voucherIdToDelete = $id->all();
        $this->VoucherService->deleteVoucher($voucherIdToDelete);
        return redirect('/admin/voucher-management');
    }
    function voucherManagementUpdate(Request $request)
    {
        $userIdToUpdate = $request->input('id');
        $data = $request->except(['_token', '_method', 'id']);
        $this->VoucherService->updateVoucher($userIdToUpdate, $data);
        return redirect('/admin/voucher-management');
    }
    function editProfileAdmin(Request $request)
    {
        return redirect("/admin/profile");

    }
    function moreTable()
    {
        $products = $this->ProductService->getProduct();
        $vouchers = $this->VoucherService->getAllActiveVouchers();
        $appliedVouchers = $this->AdminService->getProductVoucher();
        $orders = $this->AdminService->getOrders();
        $users = $this->UserService->getUsers();
        $orderDetails = $this->AdminService->getOrdersDetail();
        $paymentHistory = $this->AdminService->getPaymentHistory();
        return view("pages.admin.tableManagement", 
            [   
                'appliedVouchers' => $appliedVouchers,
                'products' => $products, 
                'vouchers' => $vouchers,
                'orders' => $orders,
                'users' => $users,
                'orderDetails' => $orderDetails,
                'paymentHistory' => $paymentHistory,
            ]);
    }
    function voucherManagementAppliedCreate(Request $request)
    {
        $product_id = $request->input('product_id');
        $vourcher_id = $request->input('vourcher_id');
        $this->AdminService->createAppliedVoucher($product_id,$vourcher_id);
        return redirect("admin/more-table?table=applied-voucher");
    }
    function voucherManagementAppliedUpdate(Request $request)
    {
        $id=$request->id;
        $product_id=$request->input('product_id');
        $voucher_id=$request->input('vourcher_id');
        $appliedVoucher = $this->AdminService->getApplied_voucher($id);
        $appliedVoucher->update([
            'product_id' => $product_id,
            'vourcher_id' => $voucher_id,
        ]);
        return redirect("admin/more-table?table=applied-voucher");
    }
    function voucherManagementAppliedDelete(Request $request)
    {
        $id=$request->id;
        $appliedVoucher = $this->AdminService->getApplied_voucher($id);
        $appliedVoucher->delete();
        return redirect("admin/more-table?table=applied-voucher");
    }
    function orderManagementCreate(Request $request)
    {
        $user_id = $request->input('user_id');
        $date=now();
        $this->AdminService->createOrder($user_id,$date);
        return redirect("admin/more-table?table=orders");
    }
    function orderManagementUpdate(Request $request)
    {
        $id=$request->id;
        $date = now();
        $user_id=$request->input('user_id');
        $appliedVoucher = $this->AdminService->getOrdersById($id)->first();
        $appliedVoucher->update([
            'user_id' => $user_id,
            'date' => $date,
        ]);        
        return redirect("admin/more-table?table=orders");
    }
    function orderManagementDelete(Request $request)
    {
        $id=$request->id;
        $appliedVoucher = $this->AdminService->getOrdersById($id)->first();
        $appliedVoucher->delete();
        return redirect("admin/more-table?table=orders");
    }
    function orderDetailManagementCreate(Request $request)
    {
        $order_id = $request->input('order_id');
        $product_id = $request->input('product_id');
        $quanity = $request->input('quanity');
        $this->AdminService->createOrderDetail($order_id,$product_id,$quanity);
        return redirect("admin/more-table?table=order_details");
    }
    function orderDetailManagementUpdate(Request $request)
    {
        $id=$request->id;
        $order_id = $request->input('order_id');
        $product_id = $request->input('product_id');
        $quanity = $request->input('quanity');
        $appliedVoucher = $this->AdminService->getOrderDetailById($id)->first();
        $appliedVoucher->update([
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quanity' => $quanity,
        ]);        
        return redirect("admin/more-table?table=order_details");
    }
    function orderDetailManagementDelete(Request $request)
    {
        $id=$request->id;
        $appliedVoucher = $this->AdminService->getOrderDetailById($id)->first();
        $appliedVoucher->delete();
        return redirect("admin/more-table?table=order_details");
    }
    function paymentHistoryManagementCreate(Request $request)
    {
        $order_id = $request->input('order_id');
        $amount = $request->input('amount');
        $this->AdminService->createpaymentHistory($order_id,$amount);
        return redirect("admin/more-table?table=payment_history");
    }
    function paymentHistoryManagementUpdate(Request $request)
    {
        $id=$request->id;
        $order_id = $request->input('order_id');
        $amount = $request->input('amount');
        $appliedVoucher = $this->AdminService->getpaymentHistoryById($id)->first();
        $payment_id=$appliedVoucher->payment_id;
        $this->AdminService->updatePayment_history($payment_id,$order_id,$amount);
        return redirect("admin/more-table?table=payment_history");
    }
    function paymentHistoryManagementDelete(Request $request)
    {
        $id = $request->id;
        $idObject = json_decode($id);
        $paymentId = $idObject->payment_id;
        $appliedVoucher = $this->AdminService->getpaymentHistoryById($paymentId)->first();
        $id=$appliedVoucher->payment_id;
        $this->AdminService->deletePaymentHistory($id);
        return redirect("admin/more-table?table=payment_history");
    }
}
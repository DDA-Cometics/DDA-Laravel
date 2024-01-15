<?php

namespace App\Repositories\Implements;

use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Applied_voucher;
use App\Models\Payment_history;
use App\Repositories\Interfaces\IAdminRepository;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    protected function getModel(): string
    {
        return Admin::class;
    }
    public function getProduct(): Collection
    {
        return Product::where('display_flag', true)->get();
    }
    public function getUser(): Collection
    {
        return User::where('display_flag', true)->get();
    }
    public function getVoucher(): Collection
    {
        return Voucher::select('*')->get();
    }
    public function getProductVoucher()
    {
        return Applied_voucher::with('product', 'voucher')->get();
    }
    public function getOrders()
    {
        return Order::select('*')->get();
    }
    public function createAppliedVoucher($product_id,$vourcher_id)
    {
        return Applied_voucher::create([
            'product_id' => $product_id,
            'vourcher_id' => $vourcher_id,
        ]);
    }
    public function getApplied_voucher($id)
    {
        return Applied_voucher::find($id);
    }
    public function createOrder($user_id,$date)
    {
        return Order::create([
            'user_id' => $user_id,
            'date' => $date,
        ]);
    }
    public function getOrdersById($id)
    {
        return Order::where('id',$id)->get();
    }
    public function getOrdersDetail()
    {
        return Order_details::select('*')->get();
    }
    public function getOrderDetailById($id)
    {
        return Order_details::where('id',$id)->get();
    }
    public function getPaymentHistory()
    {
        return Payment_history::select('*')->get();
    }
    public function createOrderDetail($order_id,$product_id,$quanity)
    {
        return Order_details::create([
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quanity' => $quanity,
        ]);
    }
    public function createpaymentHistory($order_id,$amount)
    {
        return Payment_history::create([
            'order_id' => $order_id,
            'amount' => $amount,
        ]);
    }
    public function getpaymentHistoryById($id)
    {
        return Payment_history::where('payment_id',$id)->get();
    }
    public function updatePayment_history($payment_id,$order_id,$amount)
    {
        return Payment_history::where('payment_id', $payment_id)
        ->update([
            'order_id' => $order_id,
            'amount' => $amount,
        ]); 
    }
    public function deletePaymentHistory($id)
    {
        return Payment_history::where('payment_id',$id)->delete();
    }
}
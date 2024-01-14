<?php

namespace App\Repositories\Implements;

use App\Models\Shopping_cart;
use App\Repositories\Interfaces\IShopping_cartRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Payment_history;
class Shopping_cartRepository extends BaseRepository implements IShopping_cartRepository
{
    protected function getModel(): string
    {
        return Shopping_cart::class;
    }

    // Dưới đây là Implement
    // function returnProductWithCart(): Collection{
    //     return Shopping_cart::with('products')->get();
    // }
    public function returnProductWithCart($userId): Collection
    {

        return Shopping_cart::with('products')
            ->where('id', $userId)
            ->where('display_flag', true)
            ->get();
    }
    public function updateQuanity($user_id, $product_id, $quanity)
    {
        DB::table('carts')
        ->where('id', $user_id)
        ->where('product_id', $product_id)
        ->update(['quanity' => $quanity]);
    }
    
    
    public function findByProductAndUser($product_id, $user_id)
    {
        return $this->model->where('product_id', $product_id)
                          ->where('id', $user_id)
                          ->first();
    }
    public function deleteProductToCart($user_id,$product_id)
    {
       return $this->model
       ->where('id', $user_id)
       ->where('product_id', $product_id)
       ->delete();
    }
    function applyVoucher():mixed
    {
       return DB::table('vouchers')->get();
    }
    //...............................................
    function ordered($request, $userId,$shoppingCart)
    {
        $partnerCode = $request->input('partnerCode');
        $orderId = $request->input('orderId');
        $requestId = $request->input('requestId');
        $amount = $request->input('amount');
        $orderInfo = $request->input('orderInfo');
        $orderType = $request->input('orderType');
        $transId = $request->input('transId');
        $resultCode = $request->input('resultCode');
        $message = $request->input('message');
        $payType = $request->input('payType');
        $responseTime = $request->input('responseTime');
        $extraData = $request->input('extraData');
        $signature = $request->input('signature');
        $paymentOption = $request->input('paymentOption');
        $data = [
            'partnerCode' => $partnerCode,
            'orderId' => $orderId,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderInfo' => $orderInfo,
            'orderType' => $orderType,
            'transId' => $transId,
            'resultCode' => $resultCode,
            'message' => $message,
            'payType' => $payType,
            'responseTime' => $responseTime,
            'extraData' => $extraData,
            'signature' => $signature,
            'paymentOption' => $paymentOption,
        ];
        if ($message == "Successful.") {
            // Thêm vào bảng orders
            $order = Order::create([
                'user_id' => $userId,
                'date' => now(),
            ]);

            // Lặp qua giỏ hàng và thêm vào bảng order_details
            foreach ($shoppingCart as $item) {
                Order_details::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quanity' => $item->quanity,
                ]);
            }

            // Thêm vào bảng payment_history
            Payment_history::create([
                'order_id' => $order->id,
                'amount' => $amount,
            ]);

            // Xóa giỏ hàng của người dùng sau khi đã thanh toán
            Shopping_cart::where('id', $userId)->delete();
           
        }
    }
    function  history($userId)
    {
      return  Payment_history::whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('order.orderDetails.product')->get();
    }
}

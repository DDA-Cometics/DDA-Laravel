<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IAdminService 
{
    function getProduct(): Collection;
    function getUser(): Collection;
    function getVoucher(): Collection;
    function create(array $data): mixed;
    function delete($id): mixed;
    function update($id, array $data): mixed;
    function updatePassword($userId, $newPassword);
    function getProductVoucher();
    function getOrders();
    function createAppliedVoucher($product_id,$vourcher_id);
    function getApplied_voucher($id);
    function createOrder($user_id,$date);
    function getOrdersById($id);
    function getOrdersDetail();
    function getOrderDetailById($id);
    function getPaymentHistory();
    function createOrderDetail($order_id,$product_id,$quanity);
    function createpaymentHistory($order_id,$amount);
    function getpaymentHistoryById($id);
    function updatePayment_history($payment_id,$order_id,$amount);
    function deletePaymentHistory($id);
    function getChart();
}

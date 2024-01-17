<?php
namespace App\Services\Implements;


use App\Repositories\Interfaces\IAdminRepository;
use App\Services\Interfaces\IAdminService;
use App\Models\User;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Hash;

class AdminService implements IAdminService 
{
    function __construct(
        private IAdminRepository $AdminRepository
    ){}
    function getProduct(): Collection
    {
        return $this->AdminRepository->getProduct();
    }
    function getUser(): Collection
    {
        return $this->AdminRepository->getUser();
    }
    function getVoucher(): Collection
    {
        return $this->AdminRepository->getVoucher();
    }
    function create(array $data): mixed
    {
        return $this->AdminRepository->create($data);
    }
    function delete($id): mixed
    {
        return $this->AdminRepository->delete($id);
    }
    function update($id,array $data): mixed
    {
        return $this->AdminRepository->update($id,$data);
    }
    public function updatePassword($userId, $newPassword)
    {
        $user = User::find($userId);
        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();
        }
    }
    function getProductVoucher()
    {
        return $this->AdminRepository->getProductVoucher();
    }
    function getOrders()
    {
        return $this->AdminRepository->getOrders();
    }
    function createAppliedVoucher($product_id,$vourcher_id)
    {
        return $this->AdminRepository->createAppliedVoucher($product_id,$vourcher_id);
    }
    function getApplied_voucher($id)
    {
        return $this->AdminRepository->getApplied_voucher($id);
    }
    function createOrder($user_id,$date)
    {
        return $this->AdminRepository->createOrder($user_id,$date);
    }
    function getOrdersById($id)
    {
        return $this->AdminRepository->getOrdersById($id);
    }
    function getOrdersDetail()
    {
        return $this->AdminRepository->getOrdersDetail();
    }
    function getOrderDetailById($id)
    {
        return $this->AdminRepository->getOrderDetailById($id);
    }
    function getPaymentHistory()
    {
        return $this->AdminRepository->getPaymentHistory();
    }
    function createOrderDetail($order_id,$product_id,$quanity)
    {
        return $this->AdminRepository->createOrderDetail($order_id,$product_id,$quanity);
    }
    function createpaymentHistory($order_id,$amount)
    {
        return $this->AdminRepository->createpaymentHistory($order_id,$amount);
    }
    function getpaymentHistoryById($id)
    {
        return $this->AdminRepository->getpaymentHistoryById($id);
    }
    function updatePayment_history($payment_id,$order_id,$amount)
    {
        return $this->AdminRepository->updatePayment_history($payment_id,$order_id,$amount);
    }
    function deletePaymentHistory($id)
    {
        return $this->AdminRepository->deletePaymentHistory($id);
    }
    function getChart()
    {
        return $this->AdminRepository->getChart();
    }
}

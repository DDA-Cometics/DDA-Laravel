<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IShopping_cartRepository;
use App\Services\Interfaces\IShopping_cartService;
use Illuminate\Database\Eloquent\Collection;

class Shopping_cartService implements IShopping_cartService 
{
    function __construct(
        private IShopping_cartRepository $Shopping_cartRepository,
    ){}
    public function create($data): mixed
    {
        $user_id = $data['id'];
        $product_id = $data['product_id'];
        $quanity = $data['quanity'];
        $existingCartItem = $this->Shopping_cartRepository->findByProductAndUser($product_id, $user_id);
        if ($existingCartItem) {
             $this->Shopping_cartRepository->updateQuanity($user_id, $product_id, $quanity);
            return redirect('/cart');
        }
        return $this->Shopping_cartRepository->create($data);
    }
    public function updateQuanity($user_id, $product_id, $quanity){
        return $this->Shopping_cartRepository->updateQuanity($user_id, $product_id, $quanity);
    }
    function returnProductWithCart($userId): Collection
    {

        return $this->Shopping_cartRepository->returnProductWithCart($userId);
    }
    function deleteProductToCart($user_id,$product_id)
    {
        return $this->Shopping_cartRepository->deleteProductToCart($user_id,$product_id);
    }
    function applyVoucher():mixed
    {
        return $this->Shopping_cartRepository->applyVoucher();
    }
    function ordered($request, $userId,$shoppingCart)
    {
        return $this->Shopping_cartRepository->ordered($request, $userId,$shoppingCart);
    }
    function history($userId)
    {
        return $this->Shopping_cartRepository->history($userId);
    }
}
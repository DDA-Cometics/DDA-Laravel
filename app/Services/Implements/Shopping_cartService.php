<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IShoppingCartRepository;
use App\Services\Interfaces\IShopping_cartService;
use App\Repositories\Interfaces\IDetailProductRepository;
use App\Services\Interfaces\IDetailProductService;
use Illuminate\Database\Eloquent\Collection;

class Shopping_cartService implements IShopping_cartService {
    function __construct(
        private IShoppingCartRepository $Shopping_cartRepository,
        private IDetailProductRepository $detailProductService
    ){}
    public function create($data): mixed
    {
        $user_id = $data['id'];
        $product_id = $data['product_id'];
        $quanity = $data['quanity'];
    
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng hay chưa
        $existingCartItem = $this->Shopping_cartRepository->findByProductAndUser($product_id, $user_id);
    
        if ($existingCartItem) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng

            return $this->Shopping_cartRepository->updateQuanity($user_id, $product_id, $quanity);
            
        }
        return $this->Shopping_cartRepository->create($data);
    }

    function returnProductWithCart(): Collection
    {
        return $this->Shopping_cartRepository->returnProductWithCart();
    }
    
}
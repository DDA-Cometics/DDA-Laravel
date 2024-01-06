<?php

namespace App\Repositories\Implements;

use App\Models\Shopping_cart;
use App\Repositories\Interfaces\IShoppingCartRepository;
use Illuminate\Database\Eloquent\Collection;
class Shopping_cartRepository extends BaseRepository implements IShoppingCartRepository
{
    protected function getModel(): string
    {
        return Shopping_cart::class;
    }

    // Dưới đây là Implement
    function returnProductWithCart(): Collection{
        return Shopping_cart::with('products')->get();
    }
    public function updateQuanity($user_id, $product_id, $quanity)
    {
        $cartItem = Shopping_cart::where('id', $user_id)
        ->whereHas('products', function ($query) use ($product_id) {
            $query->where('product_id', $product_id);
        })
        ->first();
        if ($cartItem) {
            // Cập nhật số lượng
            $cartItem->quanity = $quanity;
            $cartItem->save();
        }
    }
    
    public function findByProductAndUser($product_id, $user_id)
    {
        return $this->model->where('product_id', $product_id)
                          ->where('id', $user_id)
                          ->first();
    }
    
    //...............................................
}

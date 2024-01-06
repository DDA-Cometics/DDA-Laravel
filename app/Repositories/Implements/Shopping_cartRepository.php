<?php

namespace App\Repositories\Implements;

use App\Models\Shopping_cart;
use App\Repositories\Interfaces\IShoppingCartRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Shopping_cartRepository extends BaseRepository implements IShopping_cartRepository
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
    
    //...............................................
}

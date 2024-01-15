<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IShopping_cartRepository extends IBaseRepository
{
   function returnProductWithCart($userId): Collection;
   function updateQuanity($user_id,$product_id, $quanity);
   function findByProductAndUser($product_id, $user_id);
   function deleteProductToCart($user_id,$product_id);
   function applyVoucher():mixed;
   function ordered($request, $userId,$shoppingCart);
   function  history($userId);
}
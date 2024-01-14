<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;

interface IShopping_cartService {
   function create($data):mixed;
   function returnProductWithCart($userId):Collection;
   function updateQuanity($user_id, $product_id, $quanity);
   function deleteProductToCart($user_id,$product_id);
   function applyVoucher():mixed;
   function ordered($request, $userId,$shoppingCart);
   function history($userId);
}
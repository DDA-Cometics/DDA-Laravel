<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IShoppingCartRepository extends IBaseRepository{
   function returnProductWithCart(): Collection;
   function updateQuanity($user_id,$product_id, $quanity);
   function findByProductAndUser($product_id, $user_id);
}
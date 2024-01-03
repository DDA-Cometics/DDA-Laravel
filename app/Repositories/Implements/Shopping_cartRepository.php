<?php

namespace App\Repositories\Implements;

use App\Models\Shopping_cart;
use App\Repositories\Interfaces\IShopping_cartRepository;
use Illuminate\Database\Eloquent\Collection;

class Shopping_cartRepository extends BaseRepository implements IShopping_cartRepository
{
    protected function getModel(): string
    {
        return Shopping_cart::class;
    }

    // Dưới đây là Implement
    
    //...............................................
}

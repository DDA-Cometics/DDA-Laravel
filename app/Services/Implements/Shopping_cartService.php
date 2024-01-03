<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IShopping_cartRepository;
use App\Services\Interfaces\IShopping_cartService;
use Illuminate\Database\Eloquent\Collection;

class Shopping_cartService implements IShopping_cartService {
    function __construct(
        private IShopping_cartRepository $Shopping_cartRepository
    ){}

    
    
}
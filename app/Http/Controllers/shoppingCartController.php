<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\IShopping_cartService;

class shoppingCartController extends Controller
{
    protected $Shopping_cartService;

    public function __construct(IShopping_cartService $Shopping_cartService)
    {
        $this->Shopping_cartService = $Shopping_cartService;
    }

    function index() {
       
        return view("pages.Shopping_cart.index");
    } 
}

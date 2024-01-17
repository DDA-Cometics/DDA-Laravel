<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\IShopping_cartService;
use Illuminate\Support\Facades\Auth;
class shoppingCartController extends Controller
{
    protected $Shopping_cartService;
    public function __construct(IShopping_cartService $Shopping_cartService)
    {
        $this->Shopping_cartService = $Shopping_cartService;
    }
    function index(Request $request) {
        $sessionData = session()->get('user_data');
        $userId = $sessionData['id'] ?? 0;
        if ($userId ===0){
            return view("pages.login.index");
        }
        $data= $request->all();
        $this->Shopping_cartService->create($data);
        return redirect("/cart");
    }
    function updateQuanity(Request $data){
        $user_id = $data['id'];
        $product_id = $data['product_id'];
        $quanity = $data['quanity'];
        $this->Shopping_cartService->updateQuanity($user_id, $product_id, $quanity);
        return redirect("/cart");
    }
    function getToCart() {
        $sessionData = session()->get('user_data');
        $userId = $sessionData['id'] ?? 0;
        if ($userId ===0){
            return view("pages.login.index");
        }
        $vouchers=$this->Shopping_cartService->applyVoucher();
        $shoppingCart=$this->Shopping_cartService->returnProductWithCart($userId);
        return view("pages.Shopping_cart.index",["shoppingCart"=>$shoppingCart])->with("vouchers", $vouchers);
    }
    function deleteProductToCart(Request $data){
        $user_id = $data['id'];
        $product_id = $data['product_id'];
        $this->Shopping_cartService->deleteProductToCart($user_id,$product_id);
        return redirect("/cart");
    }
    function applyVoucher(){
        $vouchers=$this->Shopping_cartService->applyVoucher();
        return view("pages.Shopping_cart.index",["vouchers"=>$vouchers]);
    }
}

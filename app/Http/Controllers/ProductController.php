<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }
    function index() {
        $product = $this->productService->sortPrices();
        return view("home/index", ["products" => $product]);
    }
    function create(Request $request){
        //Insert product into database
        $data= $request->all();
        $this->productService->create($data);
        // Store the user...
 
        return redirect('/');
    }
    // ...
}

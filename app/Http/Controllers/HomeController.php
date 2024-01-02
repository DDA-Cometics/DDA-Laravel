<?php

namespace App\Http\Controllers;
use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    function __construct(
        private IProductService $productService
    ){}
    function index() {
        $product = $this->productService->sortPrices();
        return view("pages.home.index", ["products" => $product]);
    }
    function bestseller() {
        $product = $this->productService->sortPrices();
        return view("pages.bestseller.index", ["products" => $product]);
    }
}

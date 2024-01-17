<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Validator;
use App\Models\Product;



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
        $product = $this->productService->getProduct();
        return view("home/index", ["products" => $product]);
    }
    function getNewProduct()
    {
        $product = $this->productService->getNewProduct();
        return view("pages.new.index", ["products" => $product]);
    }
    function create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|url', 
            'product_name' => 'required|string|max:255',
            'size' => 'required|numeric', 
            'price' => 'required|numeric|min:0', 
            'description' => 'required|string',
            'category' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect('/admin/product-management') 
                ->withErrors($validator)
                ->withInput();
        }
        $data= $request->all();
        $this->productService->create($data);
        return redirect('/admin/product-management');
    }
    public function delete(Request $id)
    {
        $idProduct = $id->all();
        $this->productService->delete($idProduct);
        return redirect('/admin/product-management');
    }
    public function delete1(Request $id)
    {
        $idProduct =$id->all();
        $this->productService->delete1($idProduct);
        return redirect('/admin/product-management');
    }
    function update(Request $request)
    {
        $productIdUpdate= $request->input('id');
        $data = $request->all();
        $this->productService->update($productIdUpdate, $data  );

        return redirect('/admin/product-management');
    }
    public function filterProducts(Request $request)
    {
        $category = $request->input('category');
        $skinConcerns = $request->input('skin_concerns');
        $skinType = $request->input('skin_type');
        $ingredient = $request->input('ingredient');
        $query = Product::query();
        if ($category) {
            $query->where('category', $category);
        }
        if ($skinConcerns) {
            $query->where('skin_concerns', $skinConcerns);
        }
        if ($skinType) {
            $query->where('skin_type', $skinType);
        }
        if ($ingredient) {
            $query->where('ingredient', $ingredient);
        }
        $filteredProducts = $query->get();
        $productt = $this->productService->getNewProduct();
        return view("pages.bestseller.index", ["products" => $filteredProducts,"productt" => $productt]);
    }
}


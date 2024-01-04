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
        $product = $this->productService->sortPrices();
        return view("home/index", ["products" => $product]);
    }
    function getNewProduct()
    {
        $product = $this->productService->getNewProduct();
        return view("pages.new.index", ["products" => $product]);
    }
    function create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|url', // Ví dụ: Ảnh cần là URL
            'product_name' => 'required|string|max:255', // Tên sản phẩm là chuỗi không quá 255 ký tự
            'size' => 'required|numeric', // Kích thước phải là số
            'price' => 'required|numeric|min:0', // Giá sản phẩm là số không âm
            'description' => 'required|string', // Mô tả sản phẩm là chuỗi
            'category' => 'required|string', // Loại sản phẩm là chuỗi
        ]);

        if ($validator->fails()) {
            return redirect('/productManagement') // Điều hướng nếu dữ liệu không hợp lệ
                ->withErrors($validator)
                ->withInput();
        }
        //Insert product into database
        $data= $request->all();
        
        $this->productService->create($data);
        // Store the user...
 
        return redirect('/productManagement');
    }
    public function delete(Request $id)
    {
        // Tìm sản phẩm cần xóa dựa trên ID
        $idProduct = $id->all();
        $this->productService->delete($idProduct);
        // Điều hướng về trang chủ sau khi xóa sản phẩm thành công
        return redirect('/productManagement');
    }
    

    function updateP(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'image' => ['required', 'url'],
        //     'product_name' => ['required', 'string', 'max:255'],
        //     'size' => ['required', 'numeric'],
        //     'price' => ['required', 'numeric', 'min:0'],
        //     'description' => ['required', 'string'],
        //     'category' => ['required', 'string'],
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/productManagement')
        //     ->withErrors($validator)
        //         ->withInput();
        // }

        $productIdUpdate= $request->input('id');
        $data = $request->all();
        $this->productService->update($productIdUpdate, $data  );

        return redirect('/productManagement');
    }
    public function filterProducts(Request $request)
    {
        // Lấy giá trị từ form
        $category = $request->input('category');
        $skinConcerns = $request->input('skin_concerns');
        $skinType = $request->input('skin_type');
        $ingredient = $request->input('ingredient');

        // Bắt đầu với một query cho tất cả sản phẩm
        $query = Product::query();

        // Áp dụng các bộ lọc nếu có giá trị
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

        // Lấy kết quả
        $filteredProducts = $query->get();
        $product = $this->productService->getNewProduct();
        // Trả về view hiển thị kết quả filter
        return view("pages.bestseller.index", ["products" => $filteredProducts]);
    }
}


<?php

namespace App\Http\Controllers;

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
}


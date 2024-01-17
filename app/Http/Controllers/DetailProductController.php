<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IDetailProductService;
use Illuminate\Http\Request;

class DetailProductController extends Controller
{
    protected $detailProductService;
    public function __construct(IDetailProductService $detailProductService)
    {
        $this->detailProductService = $detailProductService;
    }
    function index(Request $dataProduct) {
        $id =$dataProduct->query('id');
        $data = $this->detailProductService->findById($id);
        return view("pages.detailProduct.index",["products" =>$data]);

    }
}

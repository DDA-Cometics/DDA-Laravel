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

   
    function index(Request $dataProduct) {//request []
        $id =$dataProduct->query('id');
        $data = $this->detailProductService->findById($id);
        return view("pages.detailProduct.index",["products" =>$data]);

    }
    // function create(Request $request){   
    //     //Insert product into database
    //     $data= $request->all();
    //     $this->detailProductService->create($data);
    //     // Store the user...
 
    //     return redirect('/');
    // }
    // ...
}

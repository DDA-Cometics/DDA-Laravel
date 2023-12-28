<?php

namespace App\Http\Controllers;
use App\Services\Interfaces\IAdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    protected $AdminService;

    public function __construct(IAdminService $AdminService)
    {
        $this->AdminService = $AdminService;
    }
    function index()
    {
        return view("pages.admin.index");
    }
}
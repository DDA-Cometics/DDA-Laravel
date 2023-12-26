<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;

class login_registerController extends Controller
{
    protected $UserService;

    public function __construct(IUserService $UserService)
    {
        $this->UserService = $UserService;
    }
    function index()
    {
        $User = $this->UserService->login();
        return view("pages.login.index", ["users" => $User]);
    }
}

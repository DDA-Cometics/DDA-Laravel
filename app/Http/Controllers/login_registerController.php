<?php


namespace App\Http\Controllers;

use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class login_registerController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        // Validate dữ liệu đăng nhập
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lấy dữ liệu từ request
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Thực hiện đăng nhập
        $user = $this->userService->login($data);

        if (!$user) {
            return redirect()->back()->with('error', 'Email or password is incorrect.')->withInput();
        }

        // Đăng nhập thành công, chuyển hướng đến trang thành viên
        return redirect()->route('member')->with('success', 'Login successful.');
    }
}
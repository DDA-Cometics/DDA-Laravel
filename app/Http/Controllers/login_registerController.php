<?php


namespace App\Http\Controllers;

use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\Implements\UserService;

class login_registerController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        return view("pages.login.index");
    }
    function register(Request $request)
    {
        // Validate the form input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:500',
            'confirm_email' => 'required|string|email|max:255|same:email',
            'password' => 'required|string|max:255',
            'confirm_password' => 'required|string|max:255|same:password',
            'phone_number' => 'required|string',
            'date' => 'required|date',
            'account_name' =>'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return redirect('/login') // Điều hướng nếu dữ liệu không hợp lệ
                ->withErrors($validator)
                ->withInput();
        }

        // Insert product into the database
        $data = $request->all();
        // $this->userService->register($data);
        $data = $validator->validated();
        $success = $this->userService->register($data); // Thực hiện đăng ký và trả về true nếu thành công
        
        if ($success) {
            // Đăng ký thành công
            return redirect('/login')->with('success', 'Register Successful!');
        } else {
            // Đăng ký không thành công
            return redirect('/login')->with('error', 'Register Failed!');
        }
        return redirect('/login');

        // Store the user...
        // return redirect('/login');
    }
}
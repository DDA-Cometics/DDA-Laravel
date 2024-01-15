<?php


namespace App\Http\Controllers;

use App\Models\Admin;
use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\Implements\UserService;
use Illuminate\Support\Facades\Session;

class login_registerController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }
    public function logout(Request $request)
    {
        $request->session()->flush(); // Xóa toàn bộ dữ liệu trong session

        return redirect('/'); // Chuyển hướng người dùng đến trang chính sau khi logout
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
        $dataResgister = $this->userService->register($data); // Thực hiện đăng ký và trả về true nếu thành công
        
        if (empty($dataResgister["errors"])) {
           
            return redirect('/login')->with('success', 'Register Successful!');
        } else {
           
            return redirect('/login')->with('error', 'Register Failed!' . json_encode($dataResgister["errors"]));
        }        
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = $this->userService->login($email, $password);
        if ($user) {
            $userData = [
                'image' => $user-> image,
                'email' => $user->email,
                'last_name' => $user->last_name,
                'first_name' => $user->first_name,
                'id' => $user->id,
                'user_phone' => $user->phone_number,
                'account_name' => $user->account_name,
                'address' => $user->address,
                'role' => $user->role,
            ];
            session()->put('user_data', $userData);
            if ($userData['role']=="admin"){
                return redirect('/admin/user-management');
            }
            return redirect('/');
        }
        return redirect('/login')->with('error', 'Login Failed!');
    }
}
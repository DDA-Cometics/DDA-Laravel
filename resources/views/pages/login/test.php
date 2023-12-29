<?php


use Illuminate\Support\Facades\Validator;

function validate_registration_form($data)
{
    $validator = Validator::make($data, [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'confirm_email' => 'required|email|same:email',
        'password' => 'required|min:6',
        'confirm_password' => 'required|min:6|same:password',
    ]);

    if ($validator->fails()) {
        return $validator->errors()->all();
    }

    return [];
}

// Example usage:
$data = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'example@example.com',
    'confirm_email' => 'example@example.com',
    'password' => 'password123',
    'confirm_password' => 'password123',
];

$validation_errors = validate_registration_form($data);

if (!empty($validation_errors)) {
    foreach ($validation_errors as $error) {
        echo $error . "<br>";
    }
    // Hiển thị thông báo lỗi cho người dùng để họ nhập lại thông tin
} else {
    // Tiến hành đăng ký người dùng
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;
  
    protected $table = "users";
    protected $fillable = ["id", "last_name", "first_name", "account_name", "password", "role", "address", "phone_number", "email", "image", "date", "update_at", "create_at", "display_flag"];
    public function updatePassword($oldPassword, $newPassword)
    {
        // Kiểm tra xem mật khẩu cũ có khớp hay không
        if (Hash::check($oldPassword, $this->password)) {
            // Nếu khớp, cập nhật mật khẩu mới
            $this->password = Hash::make($newPassword);
            $this->save();

            return true;
        }

        return false;
    }

}


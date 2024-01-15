<?php

namespace App\Models;
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
        if (Hash::check($oldPassword, $this->password)) {
            $this->password = Hash::make($newPassword);
            $this->save();
            return true;
        }
        return false;
    }
}


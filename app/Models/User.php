<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
  
    protected $table = "users";
    protected $fillable = ["id", "last_name", "first_name", "account_name", "password", "role", "address", "phone_number", "email", "image", "date", "update_at", "create_at", "display_flag"];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class login_register extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = ["id","last_name","first_name","account_name","password","role","address","phone_number","email","image","date","updated_at","created_at"];
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = ["id", "last_name", "first_name", "account_name", "password", "role", "address", "phone_number", "email", "image", "date", "updated_at", "created_at"];
}
class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    public function shoppingCart()
    {
        return $this->hasMany(Shopping_cart::class, 'product_id');
    }
    protected $fillable = ["id","product_name","size","price","description","category","display_flag","new","image","ingredient","skin_type","skin_concerns"];
}
class User extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = ["id","last_name","first_name","account_name","password","role","address","phone_number","email","image","date","update_at","create_at","display_flag"];
}
class Voucher extends Model
{
    use HasFactory;
    protected $table = "vouchers";
    protected $fillable = ["id","discount","description","active_datetime","expired_datetime","updated_at"];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ["id","product_name","size","price","description","category","display_flag","new","image","ingredient","skin_type","skin_concerns"];
    public function shoppingCart()
    {
        return $this->hasMany(Shopping_cart::class, 'product_id');
    }
    public function appliedVouchers()
    {
        return $this->hasMany(Applied_voucher::class, 'product_id');
    }
}

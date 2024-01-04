<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_product extends Model// trong Model chỗ nào khai báo public hoặc protected thì Detail_product đều sử dụng được 
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ["id","product_name","size","price","description","category","display_flag","new","image","ingredient","skin_type","skin_concerns"];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_product extends Model// trong Model chỗ nào khai báo public hoặc protected thì Detail_product đều sử dụng được 
{
    use HasFactory;
    protected $table ="products";//protected là  extends có thể dùng được trong namespace( == package)
    protected $fillable = ["id", "product_name", "size", "price", "description", "category", "display_flag", "new_flag", "image"];

}

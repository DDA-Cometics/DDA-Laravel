<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_product extends Model
{
    use HasFactory;
    protected $table ="products";
    protected $fillable = ["id", "product_name", "size", "price", "description", "category", "display_flag", "new_flag", "image"];
}

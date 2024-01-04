<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_cart extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $fillable = ["product_id", "voucher_id", "quanity"];
}
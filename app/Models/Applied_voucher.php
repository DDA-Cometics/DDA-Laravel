<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applied_voucher extends Model
{
    use HasFactory;
    protected $table = "applied_voucher";
    protected $fillable = ["id","product_id","vourcher_id"];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}

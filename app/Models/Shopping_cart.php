<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_cart extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $fillable = ["id","product_id","quanity","display_flag"];
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    } 
    protected static function boot()
    {
        parent::boot();
        static::updating(function ($product) {
            if ($product->isDirty('display_flag')) {
                $product->shoppingCart()->update(['display_flag' => $product->display_flag]);
            }
        });
    } 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ["id","user_id","date"];
    public function orderDetails()
    {
        return $this->hasMany(Order_details::class, 'order_id', 'id');
    }
    public function paymentHistory()
    {
        return $this->hasMany(Payment_history::class, 'order_id', 'id');
    }
}

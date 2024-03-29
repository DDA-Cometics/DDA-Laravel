<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_history extends Model
{
    use HasFactory;
    protected $table = "payment_history";
    protected $fillable = ["payment_id","order_id","amount"];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}

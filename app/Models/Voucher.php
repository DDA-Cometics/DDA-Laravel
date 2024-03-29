<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "vouchers";
    protected $fillable = ["id", "discount", "description", "active_datetime", "expired_dateime","updated_at"];
    public function appliedVouchers()
    {
        return $this->hasMany(Applied_voucher::class, 'voucher_id');
    }
}

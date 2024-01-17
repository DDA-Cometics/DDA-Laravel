<?php

namespace App\Repositories\Implements;

use App\Models\Voucher;
use App\Repositories\Interfaces\IVoucherRepository;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class VoucherRepository extends BaseRepository implements IVoucherRepository 
{
    function getModel(): string 
    {
        return Voucher::class;
    }
    function getAllActiveVouchers(): Collection
    {
        $now = new DateTime();
        return Voucher::get();
    }
}
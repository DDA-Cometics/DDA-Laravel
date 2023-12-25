<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IVoucherService {
    function getAllActiveVouchers(): Collection;
}
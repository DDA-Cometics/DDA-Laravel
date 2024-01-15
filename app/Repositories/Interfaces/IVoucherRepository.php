<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IVoucherRepository extends IBaseRepository
{
    function getAllActiveVouchers(): Collection;
}
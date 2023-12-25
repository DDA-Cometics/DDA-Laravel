<?php
namespace App\Services\Implements;

use App\Repositories\Interfaces\IVoucherRepository;
use App\Services\Interfaces\IVoucherService;
use Illuminate\Database\Eloquent\Collection;

class VoucherService implements IVoucherService {
    function __construct(
        private IVoucherRepository $voucherRepository
    ){}

    function getAllActiveVouchers(): Collection
    {
        return $this->voucherRepository->getAllActiveVouchers();
    }
    
}
<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IVoucherService {
    function getAllActiveVouchers(): Collection;
    function createVoucher(array $data): mixed;
    function deleteVoucher($id): mixed;
    function updateVoucher($id, array $data): mixed;
}
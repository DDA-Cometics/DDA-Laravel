<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IAdminService {
    function getProduct(): Collection;
    function getUser(): Collection;
    function getVoucher(): Collection;
    function create(array $data): mixed;
}
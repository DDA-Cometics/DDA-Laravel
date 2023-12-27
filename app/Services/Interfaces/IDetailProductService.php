<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IDetailProductService {
    function sortPrices(): Collection;
    function create(array $data): mixed;
}
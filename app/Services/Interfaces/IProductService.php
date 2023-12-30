<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IProductService {
    function sortPrices(): Collection;
    function create(array $data): mixed;
    function delete($id): mixed;
    function update($id,array $data): mixed;
}
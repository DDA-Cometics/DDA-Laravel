<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IProductService 
{
    function getProduct(): Collection;
    function getNewProduct(): Collection;
    function create(array $data): mixed;
    function delete($id): mixed;
    function delete1($id): mixed;
    function update($id,array $data): mixed;
    function searchProduct($searchData): Collection;
}
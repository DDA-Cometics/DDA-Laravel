<?php
namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IDetailProductService 
{
    function getProduct(): Collection;
    function create(array $data): mixed;
    function findById($id): mixed;
}
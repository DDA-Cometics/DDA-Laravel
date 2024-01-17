<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IProductRepository extends IBaseRepository
{
    function getProduct(): Collection;
    function getNewProduct(): Collection;
    function searchProduct($searchData):Collection;
}
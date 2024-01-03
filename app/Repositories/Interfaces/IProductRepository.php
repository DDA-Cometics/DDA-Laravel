<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IProductRepository extends IBaseRepository{
    function sortPrices(): Collection;
    function getNewProduct(): Collection;
}
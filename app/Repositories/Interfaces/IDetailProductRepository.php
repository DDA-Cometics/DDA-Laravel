<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IDetailProductRepository extends IBaseRepository{
    function sortPrices(): Collection;
}
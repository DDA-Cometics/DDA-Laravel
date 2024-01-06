<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IAdminRepository extends IBaseRepository{
    function getProduct(): Collection;
    function getUser(): Collection;
    function getVoucher(): Collection;
    

    
}
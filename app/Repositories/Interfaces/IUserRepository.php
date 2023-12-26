<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface IUserRepository extends IBaseRepository
{
    function login(): Collection;
}
